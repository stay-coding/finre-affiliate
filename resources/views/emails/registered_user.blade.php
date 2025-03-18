@component('mail::message')
    # Halo, {{ $data['name'] }}

    Terima Kasih sudah mendaftar di platform kami, berikut detail akun untuk masuk ke aplikasi kami.

    Email: {{ $data['email'] }}
    Password: {{ $data['password'] }}

    Terima kasih,
    Finre
@endcomponent
