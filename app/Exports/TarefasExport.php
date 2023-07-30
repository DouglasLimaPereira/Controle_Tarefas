<?php

namespace App\Exports;

use App\Models\Tarefa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TarefasExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = auth()->user(); 
        return $user->tarefas;
    }

    public function headings(): array
    {
        return [
            'Id Tarefa', 
            'Id Usuário', 
            'Tarefa', 
            'Data de conclusão',
            'Descrição',
            'Data de criação', 
            'Data de atualização'
        ];
    }

    public function map($linha): array{
        return [
            $linha->id,
            $linha->user_id,
            $linha->tarefa,
            date('d/m/Y', strtotime( $linha->data_conclusao )),
            $linha->descricao,
            date('d/m/Y', strtotime( $linha->created_at )),
            date('d/m/Y', strtotime( $linha->updated_at )),
        ];
    }
}
