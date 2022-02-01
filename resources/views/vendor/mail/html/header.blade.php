<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="{{ $url }}/img/logo.png" class="logo" alt="{{ $slot }}" width="220" height="35.17">
<img src="{{ $url }}/img/logo-white.png" class="logo-white" alt="{{ $slot }}" width="220" height="35.17">
@endif
</a>
</td>
</tr>
