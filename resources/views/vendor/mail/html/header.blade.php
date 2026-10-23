<tr>
<td class="header">
<div style="display: inline-block;">
@if (filled(app_logo()))
<img src="{{ app_logo() }}" class="logo" alt="Logo">
@else
{!! $slot !!}
@endif
</div>
</td>
</tr>
