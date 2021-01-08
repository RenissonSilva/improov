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
    <link href="https://fonts.googleapis.com/css2?family=Saira&display=swap" rel="stylesheet"> 

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
        * {
            font-family: 'Saira', sans-serif;
        }
        .main{
            background-color: #5333A5;
            height: 27vh;
            position: relative;
            z-index: 1;
        }
        .loggedNavbar {
            position: absolute;
            z-index: -1;
            display: table;
            width: 100%;
            height: 27vh;
            color: white;
            background: url('images/bg-logged.png') no-repeat bottom center scroll;
            opacity:0.7;
            background-position: 30% 45%;
            background-size: cover;
            margin:0!important;
        }
        .logo {
            width: 3.8em;
        }
        .navbar-transparent {
            background-color:transparent!important;
            box-shadow: none!important;
            padding: 4vh 15vw 0 15vw;
        }
        .item-navbar {
            color: #fff!important;
            font-size: 1.5rem;
        }
        .item-navbar:hover {
            background-color:transparent;
        }
        .avatar {
            width: 150px;
            
        }
        .avatar-div {
            position: absolute;
            margin-right: -75px;
            right: 50vw;
            bottom: -75px;
            display: inline-block;
            color: #fff;
            overflow: hidden;
            z-index: 1;
            width: 150px;
            height: 150px;
            line-height: 150px;
            padding: 0;
            border-radius: 50%;
            -webkit-transition: background-color .3s;
            transition: background-color .3s;
            cursor: pointer;
            vertical-align: middle;
        }

    </style>
</head>
<body>
    <div id="app">
        <div class="main">
            <div class="loggedNavbar"></div>
            <nav class="navbar navbar-expand-md navbar-transparent">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('images/logo.png') }}" class="logo">
                </a>
                <h3>Improov</h3>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                            <li class="nav-item">
                                <a class="dropdown-item item-navbar" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </nav>
            <div class="avatar-div">
                <img src="{{ url('images/avatar.png') }}" class="avatar">
            </div>
            
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
