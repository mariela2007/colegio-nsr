<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body{
            margin:0;
            font-family: 'Figtree', sans-serif;
        }

        /* fondo azul */
        .bg-login{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background: #0d3b66;
        }

        /* caja blanca del login */
        .login-card{
            width: 380px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            border-top: 6px solid #fcbf49; /* amarillo colegio */
        }

        /* logo */
        .logo{
            text-align:center;
            margin-bottom:20px;
        }

        .logo a{
            text-decoration:none;
            color:#0d3b66;
            font-weight:bold;
        }
    </style>
</head>

<body>

<div class="bg-login">

    <div class="login-card">

        <!-- LOGO -->
        <div class="logo">
            <a href="/">
            <img src="{{ asset('imagen/escudo2026.png') }}" 
                 alt="Logo Colegio NSR" 
                 style="width:80px; height:auto; margin:0 auto; display:block;">

            <div>Colegio NSR</div>
            </a>
        </div>

        <!-- CONTENIDO LOGIN -->
        {{ $slot }}

    </div>

</div>

</body>
</html>