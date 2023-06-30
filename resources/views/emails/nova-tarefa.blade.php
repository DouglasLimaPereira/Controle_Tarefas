<x-mail::message>
Olá sr(a) {{ $nome }},<br>
Nova Tarefa criada: {{ $tarefa }}

Data Limite de Conclusão: {{ date('d/m/Y', strtotime($data_conclusao)) }}

<x-mail::button :url='$url'>
Clique Aqui para visualizar a tarefa
</x-mail::button>

At. te,<br>
Equipe {{ config('app.name') }}
</x-mail::message>
