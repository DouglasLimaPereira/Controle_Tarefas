@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Tarefa') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.update', $tarefa->id) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label for="tarefa" class="form-label">Tarefa</label>
                            <input type="text" class="form-control" id="tarefa" name="tarefa" value="{{isset($tarefa) ? $tarefa->tarefa : old('tarefa') }}">
                            @if($errors->has('tarefa'))
                                <div style="
                                    text-align: left;
                                    border-radius: 5px;
                                    width: auto;
                                    background: red;
                                    color: white;
                                    margin-top: 2px;
                                    padding: 5px;
                                ">
                                    {{$errors->first('tarefa')}}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="data_conclusao" class="form-label">Data Limite de Conclusão</label>
                            <input type="date" class="form-control" id="data_conclusao" name="data_conclusao" value="{{isset($tarefa) ? $tarefa->data_conclusao : old('data_conclusao') }}">
                            @if($errors->has('data_conclusao'))
                                <div style="
                                    text-align: left;
                                    border-radius: 5px;
                                    width: auto;
                                    background: red;
                                    color: white;
                                    margin-top: 2px;
                                    padding: 5px;
                                ">
                                {{$errors->first('data_conclusao')}}
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="descricao" rows="3" name="descricao">{{isset($tarefa) ? $tarefa->descricao : old('descricao') }}</textarea>
                            @if($errors->has('descricao'))
                                <div style="
                                    text-align: left;
                                    border-radius: 5px;
                                    width: auto;
                                    background: red;
                                    color: white;
                                    margin-top: 2px;
                                    padding: 5px;
                                ">
                                    {{$errors->first('descricao')}}
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-3 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-success btn-lg">Atualizar</button>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
