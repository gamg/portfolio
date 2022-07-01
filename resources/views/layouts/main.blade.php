<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Aldrich" media="all">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}?ss">

        <!-- Scripts -->

        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <script src="https://kit.fontawesome.com/1bf067c1d8.js" crossorigin="anonymous"></script>

{{--        <script src="https://cdn.tailwindcss.com"></script>--}}

        @livewireStyles
    </head>
    <body>
        <div style="font-family: Aldrich">
            {{ $slot }}
        </div>

        @livewireScripts

        <!-- Sweetalert 2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
