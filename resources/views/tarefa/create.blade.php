@extends('layouts.app')
{{-- ooooi --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Adicionar Tarefa') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.store') }}">
                        <div class="mb-3">
                          <label for="tarefa" class="form-label">Tarefa</label>
                          <input type="text" class="form-control" id="tarefa" name="tarefa">
                          
                        </div>
                        <div class="mb-3">
                          <label for="data_conclusao" class="form-label">Data Limite de Conclusão</label>
                          <input type="date" class="form-control" id="data_conclusao" name="data_conclusao">
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
