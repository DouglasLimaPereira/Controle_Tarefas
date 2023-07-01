@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fa-solid fa-eye"></i> {{ __('Visualizar Tarefa') }}</div>

                <div class="card-body">
                    <div class="callout-info">
                        <b> Atividade: </b>{{$tarefa->tarefa}} <br>
                        <b> Data: </b>{{ date('d/m/Y', strtotime($tarefa->data_conclusao)) }} <br>
                        <b> Descrição: </b>{{$tarefa->descricao}}
                    </div>
                    
                    <hr>
                    <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('tarefa.create') }}" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
