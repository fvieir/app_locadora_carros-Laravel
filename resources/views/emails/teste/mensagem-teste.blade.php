<?php
    $time = date("H");
    if ($time >= 0 && $time < 12 ) {
        $salutaion = "Bom dia";
    } else if($time >= 12 && $time < 18) {
        $salutaion = "Boa tarde";
    } else {
        $salutaion = "Boa noite";
    }
?>

@component('mail::message')
# {{ $salutaion }},

A  está cheia de novidades, adequamos nossa plataforma com a Lei Geral de Proteção de Dados (LGDP), disponibilizamos novas consultas e novas funcionalidades.

Fique tranquilo, vamos te atualizar com as melhorias!  😉😄

{{ config('app.name') }}<br>
@endcomponent
