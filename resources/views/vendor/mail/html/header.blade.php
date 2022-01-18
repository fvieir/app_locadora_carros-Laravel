{{-- <tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
{{-- @if (trim($slot) === 'Laravel') --}}
<img src=""  alt="Laravel Logo">
{{-- @else --}}
{{-- @endif --}}
</a>
</td>
</tr> --}}




<?php
    /*$img = App\Helpers\ImageHelper::image_url('locashop-logo.png');*/
    $img = '';
    $alt = '';
    $actionUrl = env('APP_ADMIN_URL');
?>

<tr>
<td class="header" >
    <a style="display: block; heigth: 136px; text-align: center" href="{{ $actionUrl }}" target="_blank">
        <img src="{{ $img}}" alt="{{ $alt }}">
    </a>
    <hr style="min-height:7px;border:none; max-width:500px;color:#333;background-color:#333; min-width:40%; margin:auto; margin-top: 20px;"/>
    <h1 style="text-align: center; font-size:clamp(1.75em, 1em + 3vw, 2.5em); color: #222222; margin-top: 25px;"></h1>
{{-- <a href="{{ $url }}">
{{-- {{ $slot }} --}}
</a> 
</td>
</tr>

