<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        @yield('css')
    </head>
    <body>
        <!-- Page Heading -->
        <div class="header-body">
        @include('layouts.header')
        </div>

        <!-- Page Content -->
        <div class="content-body font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>

        <div class="footer-body text-center  flex justify-items-center items-end">
            <p class="w-full font-bold text-sm ">Atte, inc.</p>
        </div>

    </body>
</html>
