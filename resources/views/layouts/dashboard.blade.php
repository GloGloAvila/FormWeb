<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .theme--light.v-application {
  background: none !important;
  color: rgba(0, 0, 0, 0.87);
}

#inspire div.v-application--wrap {
  min-height: 60vh !important;
}

    </style>

</head>

<body>
    @auth
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endauth

    <div>
            @yield('content')
    </div>

    <script type="text/javascript">

        window.user=@json(
            [
                'user'=> auth()->user()
            ]
        );

        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            jsPermissions: {!! auth()->check()?auth()->user()->jsPermissions():null !!}
        };

    </script> 

</body>

</html>