@component('mail::message')
# Bonjour cher(e) client(e)

Le menu du jour pour <strong>{{$pack}}</strong> est désormais disponible sur votre plateforme. <br><br>
Lancez votre commande

@component('mail::button', ['url' => ''])
Commandez
@endcomponent

Cordialement,<br>
{{ config('app.name') }}
@endcomponent
