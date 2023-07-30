<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view('tarefa.index', compact('tarefas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'tarefa' => 'required|min:3',
                'data_conclusao' => 'required',
                'descricao' => 'nullable'
            ],
            [
                'tarefa.required' => 'O campo tarefa precisa ser preenchido',
                'tarefa.min' => 'O campo tarefa precisa de no minimo 3 digitos',
                'data_conclusao.required' => 'O campo Data Limite de Conclusão precisa ser preenchido',
            ]
        );

        DB::beginTransaction();
        try {
            $dados = $request->all();
            $dados['user_id'] = auth()->user()->id;

            $tarefa = Tarefa::create($dados);
            DB::commit();

            try {
                $url = "http://controle_tarefas.test/tarefa/".$tarefa->id;
                $nome = auth()->user()->name;
                Mail::to(auth()->user()->email)->send(new NovaTarefaMail($tarefa, $url, $nome));
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
            

            return redirect()->route('tarefa.show', $tarefa->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if (!$tarefa->user_id == $user_id) {
            return view('acesso-negado');
        }

        return view('tarefa.edit', compact('tarefa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if (!$tarefa->user_id == $user_id) {
            return view('acesso-negado');
        }

        $request->validate(
            [
                'tarefa' => 'required|min:3',
                'data_conclusao' => 'required',
                'descricao' => 'nullable'
            ],
            [
                'tarefa.required' => 'O campo tarefa precisa ser preenchido',
                'tarefa.min' => 'O campo tarefa precisa de no minimo 3 digitos',
                'data_conclusao.required' => 'O campo Data Limite de Conclusão precisa ser preenchido',
            ]
        );

        DB::beginTransaction();
        try {
            $dados = $request->all();
            $dados['user_id'] = auth()->user()->id;

            $tarefa->update($dados);
            DB::commit();

            // try {
            //     $url = "http://controle_tarefas.test/tarefa/".$tarefa->id;
            //     $nome = auth()->user()->name;
            //     Mail::to(auth()->user()->email)->send(new NovaTarefaMail($tarefa, $url, $nome));
            // } catch (\Throwable $th) {
            //     dd($th->getMessage());
            // }
            
            return redirect()->route('tarefa.show', $tarefa->id);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        $user_id = auth()->user()->id;
        if (!$tarefa->user_id == $user_id) {
            return view('acesso-negado');
        }

        DB::beginTransaction();
        try {
            $tarefa->delete();
            DB::commit();
            return redirect()->route('tarefa.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function exportar($extensao)
    {
        // return Excel::download(new InvoicesExport, 'invoices.pdf', \Maatwebsite\Excel\Excel::MPDF);
        if (in_array($extensao, ['xlsx', 'csv', 'pdf'])) {
            $user_nome = auth()->user()->name;
            return Excel::download(new TarefasExport, 'lista_de_tarefas('.$user_nome.').'.$extensao);
        }
        
        return redirect()->route('tarefa.index');
    }

    public function pdf()
    {
        // dd('DOM PDF');
        $tarefas = Tarefa::where('user_id', auth()->user()->id)->get();
        // dd($tarefas);
        return PDF::loadView('tarefa.tarefa-pdf',compact('tarefas'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->setPaper('a4', 'portrait')
            // ->download('tarefas-'.auth()->user()->name.'.pdf');
            ->stream('tarefas-'.auth()->user()->name.'.pdf');
            
    }
}

