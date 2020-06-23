<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>

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

        .links>a:hover {
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
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="height: 60px;">

                <div class="top-left links" >
                    <a href="{{ url('/') }}" style="text-decoration: none !important;">
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

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>