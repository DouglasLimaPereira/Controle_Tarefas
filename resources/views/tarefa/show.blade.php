@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Visualizar Tarefa') }}</div>

                <div class="card-body">
                    <b> Atividade: </b>{{$tarefa->tarefa}} <br>
                    <b> Data: </b>{{ date('d/m/Y', strtotime($tarefa->data_conclusao)) }} <br>
                    <b> Descrição: </b>{{$tarefa->descricao}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
