<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('Titulo', 'Gestion Evidencia') | UCM</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://use.fontawesome.com/bdbf641c00.js"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark" style="background: black;">   
            @guest
                <a class="nav-brand my-2 my-lg-0" href="{{ route('home') }}"><img src="{{asset("img/logo_ucm.png")}} " style="height:70px;widht:50px;"></a>
            @endguest
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
