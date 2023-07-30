<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <style>
        .titulo{
            border: 1pt;
            background-color: #c2c2c2;
            padding: 5pt;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 5pt;
        }
        .table{
            width: 100%; 
            border: 1px black;
        }

        table th{
            text-align: left;
            border: #000000 1pt;
        }
        
    </style>
</head>
<body>
    <div class="titulo">Lista de Tarefas <br> {{auth()->user()->name}}</div>
     
        {{-- <div class="container"> --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-md-12"> --}}
                    {{-- <div class="card">
                        <div class="card-body"> --}}
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data Conclusão</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tarefas as $tarefa)
                                        <tr>
                                            <th scope="row">{{$tarefa->id}}</th>
                                            <td>{{$tarefa->tarefa}}</td>
                                            <td>{{date('d-m-Y', strtotime($tarefa->data_conclusao))}}</td>
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
                        
</body>
</html>
