@component('mail::message')
# {{ $data['title'] }}

Klik tombol dibawah untuk melihat lebih detail

@component('mail::button', ['url' => $data['url']])
Visit
@endcomponent

Terimakasih
{{ config('app.name') }}
@endcomponent