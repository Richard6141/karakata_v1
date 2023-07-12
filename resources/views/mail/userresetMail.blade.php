@component('mail::message')
# Cliquez sur le bouton ci-dessous pour réinitialiser votre mot de passe.

Identifiant: <strong>{{$data['email']}}</strong><br>
id: <strong>{{$data['id']}}</strong><br>

@component('mail::button', ['url' => $data['url']])
Réinitialisation du mot de passe
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent