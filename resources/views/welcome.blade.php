<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Improov</title>
  <link rel="stylesheet" type="text/css" href="style.css">

   <!-- jQuery and script file -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src="script.js" type="text/javascript"></script>

   <!-- materialize CSS and JS -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>

   <!--Import Icon-->

   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Saira&display=swap" rel="stylesheet"> 

  <!-- mobile view-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/layout-app.css') }}" rel="stylesheet">

  <style>
* {
   font-family: 'Saira', sans-serif;
}
  .padrao {
    padding:0 10% 0 10%;
}
  .intro {
    display: table;
    width: 100%;
    height: 100vh;
    color: white;
    background: url('images/bg-home.png') no-repeat bottom center scroll;
    background-position: 30% 45%;
    background-size: cover;
    margin:0!important;
} 
.logo {
     width: 2.3em;
}
.logo2{
     width: 3.3em;
}
.test{
  padding: 4vh 15vw 0 15vw;
  }
  .icon-block {
  padding: 0 15px;
}
.icon-block .material-icons {
	font-size: inherit;
}
.nave {
  position: absolute;z-index:999999999;
}
.tex{
  color: #E4E4E4!important;
  text-shadow: 3px 3px 3px #000000;
  font-weight: normal;
  font-size:28px!important;
  line-height: 1.6!important;
  letter-spacing: 1px!important;
  height: 10em;
  position: relative;
    }
.img-content {
  width: 200px;
  height: 200px;
  padding-top: 0!important;
}
  </style>

</head>
<body>

<nav class="transparent z-depth-0 nave"  role="navigation">
    <div class="nav-wrapper container">
      <a href="#!" class="brand-logo">
      <i class="material-icons">
      <img src="{{ url('images/logo.png') }}" class="logo">
      </i>Improov
  </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html"><i class="material-icons">search</i></a></li>
        <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
        <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>
        <li><a href="mobile.html"><i class="material-icons">more_vert</i></a></li>
      </ul>
  </nav>
  </nav>
  <div class="section no-pad-bot intro" id="index-banner">
    <div class="container">
      <br><br>
      <div class="row">
      <div class="col s6 l3 25">
          <h5 class="white-text tex">
          Viemos para te ajudar a focar em seus objetivos e a aperfeiçoar
          seus conhecimentos para que você esteja mais perto da força!
          </h5>
        </div>
        </div>
      </div>
      <br><br>
    </div>
  </div>

  <div class="container ">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class=""><a>
            <img src="{{ url('../../public/images/mission.png') }}" class="img-content">
            </a></h2>
            <h5 class="center">Missões Diarias</h5>

            <p class="light">Tenha uma série de objetivos e desafios a serem alcançados todos os dias.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">group</i></h2>
            <h5 class="center">Ranking</h5>

            <p class="light">Compare a sua pontuação com as de qualquer usuário do sistema.</p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
            <h2 class="center light-blue-text"><i class="material-icons">settings</i></h2>
            <h5 class="center">Vantagens</h5>

            <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>

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


  <!--  Scripts-->

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="../../bin/materialize.js"></script>
  <script src="js/init.js"></script>
  <script>
  (function($){
  $(function(){

    $('.button-collapse').sideNav();

  }); // end of document ready
})(jQuery); // end of jQuery name space
  </script>

<!--Más en: https://scotch.io/tutorials/make-material-design-websites-with-the-materialize-css-framework-->
<!--https://scotch.io/tutorials/make-material-design-websites-with-the-materialize-css-framework-->
</body>
</html>