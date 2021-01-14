<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Improov</title>

    <!-- CSS & ICONS -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="{{ asset('css/modal.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Saira&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>

<body>
    <div class="back container-default" style="height:100vh;">
        <nav class="transparent row">
            <div class="nav-wrapper valign-wrapper col">
                <img src="{{ url('images/logo.png') }}" class="logo">
                <span class="title">Improov</span>
            </div>

            <ul class="right h-100">
                <a class="waves-effect waves-light btn-large modal-trigger btn-default btn-login" href="#modal-login"><i class="material-icons left icon-code">code</i>Comece a programar</a>
                @include('layouts.modal-login')
            </ul>
        </nav>

        <div class="div-descricao valign-wrapper">
            <span class="descricao">Viemos para te ajudar a focar em seus objetivos e a aperfeiçoar seus conhecimentos para que você esteja mais perto da força!</span>
        </div>
    </div>

    <div class="container-default row container-advantages">
        <div class="col s3 m4 l3">
            <img src="{{ url('images/mission.png') }}" class="icon-about">
        </div>
        <div class="col s9 m8 l9">
            <p class="title-advantage">Missões diárias</p>
            <p class="text-advantage">Tenha uma série de objetivos e desafios a serem alcançados todos os dias.</p>
        </div>
    </div>

    <div class="container-default"><div class="line-advantage"></div></div>

    <div class="container-default row container-advantages">
        <div class="col s9 m8 l9">
            <p class="title-advantage">Ranking</p>
            <p class="text-advantage">Compare a sua pontuação com as de qualquer usuário do sistema.</p>
        </div>
        <div class="col s3 m4 l3">
            <img src="{{ url('images/ranking.png') }}" class="icon-about right">
        </div>
    </div>

    <div class="container-default"><div class="line-advantage"></div></div>

    <div class="container-default row container-advantages">
        <div class="col s1 m4 l4 center-align">
            <p class="text-advantage last-3-advantages">Alcance seus objetivos</p>
            <img src="{{ url('images/goals.png') }}" class="icon-about">
        </div>
        <div class="col s1 m4 l4 center-align">
            <p class="text-advantage last-3-advantages">Aperfeiçoe seus conhecimentos</p>
            <img src="{{ url('images/knowledge.png') }}" class="icon-about">
        </div>
        <div class="col s1 m4 l4 center-align">
            <p class="text-advantage last-3-advantages">Promoção em cursos</p>
            <img src="{{ url('images/discount.png') }}" class="icon-about">
        </div>
    </div>
    
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
    $(document).ready(function(){
        $('.modal').modal();
        $('.tooltipped').tooltip();
    });
  </script>

  </body>
</html>
