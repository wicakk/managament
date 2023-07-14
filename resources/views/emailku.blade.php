@component('mail::message')
# {{ $data['title'] }}

Halo, Silahkan cek Aplikasi Management anda dikarenakan anda memiliki deadline

@component('mail::button', ['url' => $data['url']])
Visit
@endcomponent

Terimakasih
{{ config('app.name') }}
@endcomponent