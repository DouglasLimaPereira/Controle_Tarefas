@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Adicionar Tarefa') }}
                    
                    <a href="{{ route('tarefa.create') }}" class="btn btn-primary float-end ms-1">Nova Tarefa</a>
                    <a href="{{ route('tarefa.export') }}" class="btn btn-warning float-end">Exportar Excel</a>
                </div>
                
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tarefa</th>
                            <th scope="col">Data Conclusão</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($tarefas as $tarefa)
                                <tr>
                                    <th scope="row">{{$tarefa->id}}</th>
                                    <td>{{$tarefa->tarefa}}</td>
                                    <td>{{date('d-m-Y', strtotime($tarefa->data_conclusao))}}</td>
                                    <td>
                                        <div class="dropdown d-flex justify-content-center">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-duotone fa-list"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('tarefa.show', $tarefa->id) }}">Visualizar</a></li>
                                                <li><a class="dropdown-item" href="{{ route('tarefa.edit', $tarefa->id) }}">Editar</a></li>
                                                <li style="cursor: pointer">
                                                    <form id="form_{{$tarefa->id}}" action="{{ route('tarefa.destroy', $tarefa->id) }}" method="POST">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <a class="dropdown-item text-danger" onclick="remover({{$tarefa->id}})">Deletar</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>    
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span class="text-danger">Nenhum registro encontrado</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <nav class="mb-0">
                        <ul class="pagination justify-content-end ">
                          <li class="page-item"><a class="page-link text-secondary" href="{{$tarefas->previousPageUrl()}}">Voltar</a></li>
                          @for ($i = 1; $i <= $tarefas->lastPage() ; $i++)
                            <li class="page-item link-secondary {{($tarefas->currentPage() == $i) ? 'active' : ''}}">
                                <a class="page-link" href="{{$tarefas->Url($i)}}">{{$i}}</a>
                            </li>
                          @endfor
                          <li class="page-item"><a class="page-link text-secondary" href="{{$tarefas->nextPageUrl()}}">Avançar</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function remover(tarefa){
        $confirmacao = confirm('Tem certeza que deseja remover esta tarefa?');

        if($confirmacao){
            let form = document.getElementById("form_"+tarefa+"");
            form.submit();
        }
    }
</script>

@endsection
