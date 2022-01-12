@component('mail::message')
# Introdução

Este é o corpo da mensagem

@component('mail::button', ['url' => ''])
        Botão do teste
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
