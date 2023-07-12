<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'eFOOD')
<img src="https://web.topfood.bj/images/LogotTF.png" class="logo" alt="eFOOD Logo" style="width: 100%">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
