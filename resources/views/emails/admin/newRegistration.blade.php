@component('mail::message')
# Poštovani,

Novi korisnik {{$user->username}} je registrovan!

@component('mail::button', ['url' => config('app.url')])
Omogućite novom korisniku kreiranje postova
@endcomponent

Hvala,<br>
{{ config('app.name') }}
@endcomponent
