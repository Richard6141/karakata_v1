@component('mail::message')
# Identifiant et mot de passe

Identifiant: <strong>{{$data['username']}}</strong><br>
Mot de passe: <strong>{{$data['password']}}</strong><br>

@component('mail::button', ['url' => $data['url']])
Se connecter
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
