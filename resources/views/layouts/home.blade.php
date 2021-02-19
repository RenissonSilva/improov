<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Improov</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

    <!-- Materialize -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>
    <div id="app">
        <div class="main mb-5">
            <div class="loggedNavbar"></div>
            <nav class="navbar navbar-expand-md navbar-transparent">
                <a class="navbar-brand" href="{{ route ('home') }}">
                    <img src="{{ url('images/logo.png') }}" class="logo">
                </a>
                <a class="simple_link" href="{{ route ('home') }}"><h4>Improov</h4></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" >
                        <li class="nav-item">
                            <a class='dropdown-trigger btn-large dropdown-home-layout' href='#' data-target='dropdown-logged'>Olá, {{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a>

                            <ul id='dropdown-logged' class='dropdown-content'>
                            <li><a href="{{ route('home') }}"> Início </a></li>
                            <li><a href="{{ route('repos') }}">Meus Projetos </a></li>
                            <li><a href="{{ route('mission') }}">Minhas missões </a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="navbar navbar-expand-md default-padding">
                {{-- <div class="btn-floating waves-effect waves-light btn-home"><i class="fas fa-crown"></i></div><h4 class="white-text stats-user">{{$level}}</h4> --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto" >
                        <li class="nav-item">
                            <div class="btn-floating waves-effect waves-light btn-home"><i class="fas fa-fire"></i></div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="avatar-div">
                <img src="{{ Auth::user()->image }}" class="avatar">
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
    @include('layouts.scripts')
    @yield('scripts')
</body>
</html>
