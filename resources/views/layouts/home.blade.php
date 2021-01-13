<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Improov</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Saira&display=swap" rel="stylesheet"> 

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/layout-home.css') }}" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
    <div id="app">
        <div class="main mb-5">
            <div class="loggedNavbar"></div>
            <nav class="navbar navbar-expand-md navbar-transparent">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('images/logo.png') }}" class="logo">
                </a>
                <h4>Improov</h4>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" >
                        <li class="nav-item">
                            <a class="dropdown-item item-navbar" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="navbar navbar-expand-md default-padding">
                <div class="btn-floating waves-effect waves-light btn-home"><i class="fas fa-crown"></i></div><h4 class="white-text stats-user">{{$level}}</h4>
                <div class="btn-floating waves-effect waves-light btn-home"><h4 class="btn-xp">XP</h4></div><h4 class="white-text stats-user">{{$xp}} / {{$next_level}}</h4>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" >
                        <li class="nav-item">
                            <div class="btn-floating waves-effect waves-light btn-home"><i class="fas fa-fire"></i></div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="avatar-div">
                <img src="{{ url('images/avatar.png') }}" class="avatar">
            </div>
        </div>
        <main>
            @yield('content')
        </main>
        <footer class="page-footer valign-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-3 l2 s2 valign-wrapper">
                        <img src="{{ url('images/logo.png') }}" class="logo-footer">
                        <p class="white-text text-footer">Improov</p>
                    </div>
                    <div class="col l10 s6 hide-on-med-and-down link-footer">
                        <a class="grey-text text-lighten-3 right" href="#!">Ajuda</a>
                        <a class="grey-text text-lighten-3 right" href="#!">Termos de privacidade</a>
                        <a class="grey-text text-lighten-3 right" href="#!">Fale conosco</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
</body>
</html>
