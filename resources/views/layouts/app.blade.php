<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

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
                    <img width="18px" src="/favicon.ico" alt="Logo TelemeTT">
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
                            @can('devices.menu')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dispositivos</a>
                                    <div class="dropdown-menu">
                                        @can('devices.index')
                                            <a class="dropdown-item" href="{{ route('devices.index') }}">Mis Dispositivos</a>
                                        @endcan
                                        @can('devices.all')
                                            <a class="dropdown-item" href="{{ route('devices.all') }}">Todos los Dispositivos</a>
                                        @endcan
                                        @can('devices.create')
                                            <a class="dropdown-item" href="{{ route('devices.create')}}">Agregar Dispositivo</a>
                                            <div class="dropdown-divider"></div>
                                        @endcan
                                        <a class="dropdown-item" href="{{ route('info') }}">Informacion</a>
                                    </div>
                                </li>
                            @endcan
                            @can('alerts.menu')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Alertas</a>
                                    <div class="dropdown-menu">
                                        @can('alerts.index')
                                            <a class="dropdown-item" href="{{ route('alerts.index') }}">Mis Alertas</a>
                                        @endcan
                                        @can('alerts.index')
                                            <a class="dropdown-item" href="{{ route('rules.index') }}">Horarios Permitidos</a>
                                        @endcan
                                        @can('alerts.all')
                                            <a class="dropdown-item" href="{{ route('alerts.all') }}">Todas las Alertas</a>
                                        @endcan
                                        <a class="dropdown-item" href="{{ route('info') }}">Informacion</a>
                                    </div>
                                </li>
                            @endcan
                            @can('pays.menu')
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Pagos</a>
                                    <div class="dropdown-menu">
                                        @can('pays.index')
                                            <a class="dropdown-item" href="{{ route('pays.index') }}">Mis Pagos</a>
                                        @endcan
                                        @can('pays.all')
                                            <a class="dropdown-item" href="{{ route('pays.all') }}">Todos los Pagos</a>
                                        @endcan
                                        <a class="dropdown-item" href="{{ route('info') }}">Informacion</a>
                                    </div>
                                </li>
                            @endcan
                        </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        @can('config.menu')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Configuracion</a>
                                <div class="dropdown-menu">
                                    @can('users.index')
                                        <a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a>
                                    @endcan
                                    @can('permissions.index')
                                        <a class="dropdown-item" href="{{ route('permissions.index') }}">Permisos</a>
                                    @endcan
                                    @can('roles.index')
                                        <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                                    @endcan
                                    <div class="dropdown-divider"></div>
                                    @can('prices.index')
                                        <a class="dropdown-item" href="{{ route('prices.index') }}">Precios</a>
                                    @endcan
                                    @can('mail-alerts.index')
                                        <a class="dropdown-item" href="{{ route('mail-alerts.index') }}">Mail Alerts</a>
                                    @endcan
                                    @can('webhooks.index')
                                        <a class="dropdown-item" href="{{ route('webhooks.index') }}">Webhooks</a>
                                    @endcan
                                </div>
                            </li>
                        @endcan
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
                                    @can('users.show-me')
                                        <a class="dropdown-item" href="{{ route('users.show-me') }}">Mi perfil</a>
                                    @endcan
                                    <a class="dropdown-item" href="{{ route('info') }}">Informacion</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(isset($errors) && $errors->any())
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-danger">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(session()->has('success'))
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="alert alert-success">
                            <button class="close" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul>
                                @foreach(session()->get('success') as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
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
