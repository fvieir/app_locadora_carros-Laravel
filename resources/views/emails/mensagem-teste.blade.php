@component('mail::message')
# Bom dia

A - está cheia de novidades, adequamos nossa plataforma com a Lei Geral de Proteção de Dados (LGDP), disponibilizamos novas consultas e novas funcionalidades.

@component('mail::table')
|               |               | 
| :-----------: |:-------------:| 
| <img src="https://mcusercontent.com/9fa98417217f206989e878a45/images/452e7f0d-30b3-6e9d-0207-7f8967f06b55.gif" alt=""> | <img src="https://mcusercontent.com/9fa98417217f206989e878a45/images/452e7f0d-30b3-6e9d-0207-7f8967f06b55.gif" alt="">      | 

@endcomponent



@component('mail::button', ['url' => ''])
        Botão do teste
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
