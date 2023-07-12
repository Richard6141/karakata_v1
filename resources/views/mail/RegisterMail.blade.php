@component('mail::message')
# Bienvenue

M/Mme. {{$mailData['name']}}, vous venez d'avoir un compte sur <strong>KARAKATA Manager</strong><br>.
Voici vos indentifiant de connexion:<br>
    Email : <strong>{{$mailData['email']}}</strong> <br>
    Mot de passe : <strong>{{$mailData['password']}}</strong> <br>
    Veuillez cliquer sur le bouton pour vous connecter

@component('mail::button', ['url' => $mailData['url']])
Se connecter
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
