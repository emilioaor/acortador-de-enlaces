<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>@yield('title', 'ShorterLinkEO')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header id="header">
        <div class="container">
            <a href="{{ Auth::check() ? route('link.index') : route('index.index') }}">
                <h3>ShorterLinkEO <span class="glyphicon glyphicon-scissors"></span></h3>
                @if(Auth::check())
                    <a href="{{ route('index.logout') }}">( Salir )</a>
                @else
                    <a href="{{ route('index.register') }}">( Registro )</a>
                @endif
            </a>
        </div>
    </header>

    <section id="main">
        <div class="container">

            @if(Session::has('alert-msg') && Session::has('alert-type'))
                <div id="space-alert">
                    <div class="alert alert-success {{ Session::get('alert-type') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Atención!</strong> {{ Session::get('alert-msg') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="text-center">
                <p>&copy; Derechos reservado a Emilio Ochoa</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('js')
</body>
</html>