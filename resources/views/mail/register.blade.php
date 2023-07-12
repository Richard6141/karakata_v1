@component('mail::message')
M/Mme. {{$mailData['name']}}, vous venez d'avoir un compte sur <strong>KARAKATA Manager</strong><br> en tant que {{$mailData['role']}}
Voici vos indentifiants de connexion: <br>
    Email : <strong>{{$mailData['email']}}</strong> <br>
    Mot de passe : <strong>{{$mailData['password']}}</strong>
    Veuillez cliquer sur le bouton pour vous connecter

@component('mail::button', ['url' => 'url'])
Se connecter
@endcomponent

Cordialement<br>
{{ config('app.name') }}
@endcomponent
