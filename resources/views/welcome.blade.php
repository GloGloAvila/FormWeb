<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
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

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .bottom-left {
            position: absolute;
            left: 50px;
            bottom: 40px;
            height: 50px;
        }

        .bottom-right {
            position: absolute;
            right: 50px;
            bottom: 40px;
            height: 50px;
        }

        .bottom-center {
            position: absolute;
            bottom: 30px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
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

        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="top-left links">
            <a href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">{{ __('Inicio') }}</a>
            @else
            <a href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
            @endauth
        </div>
        @endif



        <div class="content">

            <img src="/logo-spe-footer.png" alt="">

            <div class="title m-b-md">
                Resolución 293 de 2017
            </div>

            <div style="display: flex; justify-content: center;">
                <div class="links m-b-md">
                    Apreciado prestador reciba un cordial saludo de parte de la Unidad Administrativa Especial del Servicio Público de Empleo.
                    <br />
                    Inicie sesión para realizar el reporte mensual de Información.
                </div>
            </div>

        </div>

        <div class="bottom-left" style="align-items: center;">
            <img src="/logo-spe.png" alt="" width="200px" height="83px">
        </div>
        <div class="bottom-center">
            @ 2020
        </div>
        <div class="bottom-right">
            <img src="/logo-mintrabajo.png" width="340px" height="66px" alt="">
        </div>

    </div>
</body>

</html>