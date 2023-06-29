@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Controle de Tarefas')
<img src="https://cdn-icons-png.flaticon.com/512/2018/2018664.png" class="logo" alt="Laravel Logo">
<br>Controle de Tarefas
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
