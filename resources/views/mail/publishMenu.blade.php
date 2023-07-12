@component('mail::message')
{{-- <img class="" height="100" width="100" src="{{ URL::asset('image/' . $data['image']) }}" alt="Image"> --}}
Bonjour cher(es) client(es)😋😋 <br>
Au menu ce {{$data['date']}}, nous vous proposons:<br><br>
Pour les plats de résistance, vous avez le choix entre :<br>
@foreach ($data['resistance'] as $key => $item)
<strong style="color: black"> Résistance {{$key + 1}} :</strong> {{$item}} <br>
@endforeach
<strong style="color: black"> Entrée :</strong> {{$data['entree']}}🥤 <br>
<strong style="color: black"> Dessert :</strong> {{$data['dessert']}} <br>
<strong style="color: black"> Boisson :</strong> {{$data['boisson']}}🥤 <br>
<strong style="color: black"> Accompagnement :</strong> {{$data['accompagnement']}}🥤 <br><br>
Miam, Bonne dégustation 😋😋😋! <br>
Un pack Top Food, un vrai régal... <br>
Pour toute commande appelez le 65 55 55 55/69 12 12 12 (Appel et WhatsApp) <br>

@component('mail::button', ['url' => ''])
Commander
@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
