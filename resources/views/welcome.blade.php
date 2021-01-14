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
