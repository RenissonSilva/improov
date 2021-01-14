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
    <nav class="transparent z-depth-0 nave" role="navigation">
        <div class="back">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo"> <img  src="{{ url('images/logo.png') }}" class="logo"> 
        
            <!-- COLOCAR O IMPRROV DO LADO-->
            <i class="right text-log">Improov</i>
            <!-- Modal Trigger -->
        
            <ul class="right hide-on-med-and-down">
                <li>
                    <a class="waves-effect waves-light btn modal-trigger" href="#modal-login">Comece a programar</a>
                    @include('layouts.modal-login')
                </li>
            </ul>
        </div>
    </nav>
    
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <script>
  $(document).ready(function(){
    $('.modal-trigger').leanModal({
      dismissible: true, // Modal can be dismissed by clicking outside of the modal
      opacity: .5, // Opacity of modal background
      in_duration: 300, // Transition in duration
      out_duration: 200, // Transition out duration
      ready: function() { alert('Ready'); }, // Callback for Modal open
      complete: function() { alert('Closed'); } // Callback for Modal close
    });

    $('.tooltipped').tooltip();
  });
    (function($){
    $.fn.leanModal = function(options) {
        if( $('.modal').length > 0 ){
            $('.modal').modal(options);
        }
    };

    $.fn.openModal = function(options) {
        $(this).modal(options);
        $(this).modal('open');
    };

    $.fn.closeModal = function() {
        $(this).modal('close');
    };
    })(jQuery);
  </script>

  </body>
</html>
