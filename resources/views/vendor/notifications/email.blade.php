@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Bonjour')
@endif
@endif
<br><br>
Pour réinitialiser votre mot de passe, veuillez cliquer sur le bouton Réinitialiser


{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
Réinitialiser
@endcomponent
@endisset

{{ config('app.name') }}

{{-- Subcopy --}}
@endcomponent
