@props(['url'])
<tr>
    <td class="header" style="text-align: center; padding: 20px 0;">
        <a href="{{ $url }}" style="display: inline-block;">
            <img src="{{ asset('assets/logo.png') }}" style="width: 150px; height: auto;"
                alt="{{ config('app.name') }} Logo">
        </a>
    </td>
</tr>
