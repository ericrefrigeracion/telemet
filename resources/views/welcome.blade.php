<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TelemeT - IOT Services</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="icon" type="image/x-icon" href="favicon.ico">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url('4.jpg');
                background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 250;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 74px;
            }

            .subtitle {
                font-weight: bold;
                font-size: 30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Panel Principal</a>
                    @else
                        <a href="{{ route('login') }}">Iniciar Sesion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Registrarme</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    TelemeT
                </div>
                <div class="subtitle m-b-md">
                    Sistema de Gestion de Temperaturas y Monitoreo
                </div>
            </div>
        </div>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="subtitle m-b-md">
                    Complete el siguiente formulario para solicitar informacion
                </div>
                <div class="subtitle m-b-md">

                </div>
            </div>

            <div class="content">
                <div class="subtitle m-b-md">

                </div>
                <div class="subtitle m-b-md">

                </div>
            </div>


        </div>
    </body>
</html>
