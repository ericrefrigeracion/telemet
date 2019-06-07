<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="nav navbar-nav">

                </ul>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                         @can('devices.index')
                    <li class="nav-item">
                        <a class="nav-link {{ setActive('home') }}" href="{{ url('/home') }}">
                        Panel Principal</a>
                    </li>
                    @endcan
                    @can('devices.index')
                    <li class="nav-item">
                        <a class="nav-link {{ setActive('devices.index') }}" href="{{ route('devices.index') }}">Dispositivos</a>
                    </li>
                    @endcan
                    @can('alerts.index')
                    <li class="nav-item">
                        <a class="nav-link {{ setActive('alerts.index') }}" href="{{ route('alerts.index') }}">Alertas</a>
                    </li>
                    @endcan



                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administrador</a>
                        <div class="dropdown-menu">
                            @can('devices.all')
                                <a class="dropdown-item {{ setActive('devices.all') }}" href="{{ route('devices.all') }}">Dispositivos-Todos</a>
                            @endcan
                            <div class="dropdown-divider"></div>
                            @can('roles.index')
                                <a class="dropdown-item {{ setActive('roles.index') }}" href="{{ route('roles.index') }}">Roles</a>
                            @endcan
                            @can('users.index')
                                <a class="dropdown-item {{ setActive('users.index') }}" href="{{ route('users.index') }}">Usuarios</a>
                            @endcan
                        </div>
                    </li>
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('info'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="alert alert-success" role="alert">
                            {{ session('info') }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @yield('content')
        </main>
    </div>
    @yield('pie')
</body>
</html>
