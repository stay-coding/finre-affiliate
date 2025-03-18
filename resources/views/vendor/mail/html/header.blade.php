@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="{{ asset('assets/logo.png') }}" class="logo" alt="{{ config('app.name') }} Logo">
        </a>
    </td>
</tr>
