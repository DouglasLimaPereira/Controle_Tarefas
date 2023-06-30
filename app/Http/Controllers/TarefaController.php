<?php

namespace App\Http\Controllers;

use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
        dd(Tarefa::all());
        if (auth()->check()) {
            $id = auth()->user()->id;
            $nome = auth()->user()->name;
            $email = auth()->user()->email;

            return "ID: $id | Usuário: $nome | E-mail: $email";
        }
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
            $tarefa = Tarefa::create($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarefa $tarefa)
    {
        //
    }
}
