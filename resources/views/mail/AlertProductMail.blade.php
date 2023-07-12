@component('mail::message')
# {{ $data['title'] }}

Bonjour cher gestionnaire de stock,
Vous recevez ce mail parce que le produit <strong>{{ $data['product_name'] }}</strong> a atteint ou est en dessous de son stock de sécurité

@component('mail::table')
| Produit       | Stock de sécurité         | Stock disponible         |
| :--------- | :------------- | :------------- |
| {{ $data['product_name'] }} | {{ $data['product_safety_stock'] }} | {{ $data['product_available_stock'] }} |
@endcomponent

Cordialement,<br>

{{ config('app.name') }}
@endcomponent