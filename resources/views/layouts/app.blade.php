<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TelemeT') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('head_scripts')

    <script src="https://kit.fontawesome.com/a2f903f9d9.js"></script>
</head>
<body>
    <div id="app">
        @include('layouts.partials.nav_bar')
        <main class="py-4 mt-5 mb-5">
            @include('layouts.partials.errors')
            @yield('content')
        </main>
        @include('layouts.partials.footer')
    </div>
    @yield('footer_scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
