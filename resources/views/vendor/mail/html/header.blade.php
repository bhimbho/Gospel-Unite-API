<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Gospel Unites')
<img src="/admin/images/logo_black.png" class="logo" alt="Gospel Unites">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
