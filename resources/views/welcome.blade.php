<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Improov</title>
        
        <!-- Bulma and Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Saira&display=swap" rel="stylesheet">  

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}}
        </style>
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
            .pink{
                background-color: #F8359E!important;
                box-shadow: 0 0 1em #F8359E;
            }
            .pink:hover{
                background-color: #f754ac!important;
                box-shadow: 0 0 1em #f754ac;
            }
            button > span {
                font-weight: bold;
            }
            button {
                border-radius: 20px!important;
            }
            .icon {
                margin-right:15px!important;
            }
            .github-icon-size{
                font-size: 1.7em;
            }
            .register-icon-size {
                font-size: 1.5em;
            }
            .logo {
                width: 3.8em;
            }
            .h-80{
                height: 80vh;
            }
            .bg-text {
                color: #E4E4E4!important;
                text-shadow: 3px 3px 3px #000000;
                font-weight: normal;
                font-size:55px!important;
                line-height: 1.6!important;
                letter-spacing: 1px!important;
            }
            .img-content {
                width: 200px;
                height: 200px;
                padding-top: 0!important;
            }
            .title {
                font-size: 30px;
                margin-top: 3vh;
                color: #000;
            }
            .subtitle {
                margin-top: 2vh!important;
                color: #575757;
                font-size:25px;
            }
            .is-ancestor {
                padding: 5vh 10vw 5vh 10vw;
                border-bottom: 2px solid #5333A5;
                margin-top: 12px!important;
            }
            .level {
                padding-top: 2vh!important;
            }
            .is-medium{
                width:70%;
            }
            .discount {
                width:160px;
            }
            .tile.is-ancestor:not(:last-child) {
                margin-bottom: 0;
            }
            .reset-level {
                margin-bottom: 0!important;
                padding: 0 10vw 0 10vw;
            }
            a:hover{
                color: #ccc!important;
            }
            .tamanho-fonte {
                font-size: 28px;
            }

            @media only screen and (max-width: 1400px) {
                .is-medium{
                    width:100%;
                }
                .bg-text {
                    font-size:50px!important;
                }
            }
            @media only screen and (max-width: 768px) {
                .bg-text {
                    font-size:40px!important;
                }
            }
        </style>
    </head>
    <body>
        <div class="padrao intro">
            <nav class="level">
                <div class="level-left">
                    <div class="level-item">
                        <img src="{{ url('images/logo.png') }}" class="logo">
                    </div>
                    <div class="level-item">
                        <h1 class="is-size-1">Improov</h1>
                    </div>
                </div>

                <div class="level-right has-text-centered">
                    @auth
                        <a href="{{ url('/dashboard') }}">
                            <button class="button is-danger pink mx-2 p-5">
                                <span class="icon">
                                <i class="fas fa-home register-icon-size"></i>
                                </span>
                                <span>Início</span>
                            </button>
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">
                                <button class="button is-danger pink mx-2 p-5">
                                    <span class="icon">
                                        <i class="fas fa-sign-in-alt register-icon-size"></i>
                                    </span>
                                    <span>Cadastrar</span>
                                </button>
                            </a>
                        @endif
                        <a href="{{ route('login') }}">
                            <button class="button is-danger pink mx-2 p-5">
                                <span class="icon is-large">
                                    <i class="fab fa-github github-icon-size"></i>
                                </span>
                                <span>Entrar com github</span>
                            </button>
                        </a>
                    @endauth
                </div>
            </nav>

            <section class="hero is-medium">
                <div class="hero-body"></div>

                <div class="hero-foot">
                    <div class="container">
                    <p class="bg-text is-size-1">
                        Viemos para te ajudar a focar em seus objetivos e a aperfeiçoar
                        seus conhecimentos para que você esteja mais perto da força!
                        </p>
                    </div>
                </div>
            </section>
        </div>

        <div class="padrao">
            <div class="tile is-ancestor">
                <div class="tile is-parent">
                    <div class="tile is-child has-text-centered">
                        <img src="{{ url('images/mission.png') }}" class="img-content">
                    </div>
                </div>
                <div class="tile is-6 is-vertical is-parent">
                    <div class="tile is-child">
                        <p class="title">Missões diárias</p>
                        <p class="subtitle">Tenha uma série de objetivos e desafios a serem alcançados todos os dias.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="padrao">
            <div class="tile is-ancestor">
                <div class="tile is-6 is-vertical is-parent">
                    <div class="tile is-child">
                        <p class="title">Ranking</p>
                        <p class="subtitle">Compare a sua pontuação com as de qualquer usuário do sistema.</p>
                    </div>
                </div>
                <div class="tile is-parent">
                    <div class="tile is-child has-text-centered">
                        <img src="{{ url('images/ranking.png') }}" class="img-content">
                    </div>
                </div>
            </div>
        </div>

        <div class="padrao">
            <p class="title has-text-centered pt-5">Vantagens</p>
        </div>
        <div class="tile is-ancestor has-text-centered">
            <div class="tile">
                <div class="tile is-parent is-vertical mb-6">
                    <article class="tile is-child">
                    <p class="subtitle is-12">Alcance seus objetivos</p>
                    </article>
                    <article class="tile is-child">
                    <img src="{{ url('images/goals.png') }}" class="img-content">
                    </article>
                </div>
            </div>

            <div class="tile">
                <div class="tile is-parent is-vertical mb-6">
                    <article class="tile is-child">
                    <p class="subtitle is-12">Aperfeiçoe seus conhecimentos</p>
                    </article>
                    <article class="tile is-child">
                    <img src="{{ url('images/knowledge.png') }}" class="img-content">
                    </article>
                </div>
            </div>

            <div class="tile">
                <div class="tile is-parent is-vertical mb-6">
                    <article class="tile is-child">
                    <p class="subtitle is-12">Promoção em cursos</p>
                    </article>
                    <article class="tile is-child">
                    <img src="{{ url('images/discount.png') }}" class="img-content discount">
                    </article>
                </div>
            </div>
        </div>

        <!--
        <nav class="level reset-level" style="background-color:#5333A5;">
            <div class="level-left has-text-white">
                <div class="level-item">
                    <h1 class="is-size-1">Improov</h1>
                </div>
            </div>
        </nav>
        -->

        <div class="tile is-ancestor" style="background-color:#5333A5;margin-top:0px!important;">
            <div class="tile is-parent is-justify-content-center">
                <article class="tile is-child is-10">
                <p class="is-size-3 has-text-white has-text-centered mb-5 has-text-weight-bold">Quem somos</p>
                <p class="tamanho-fonte has-text-white">Uma equipe de desenvolvedores em busca de trazer ferramentas que auxiliem na sua vida</p>
                </article>
            </div>
            <div class="tile is-parent is-justify-content-center">
                <article class="tile is-child is-10">
                <p class="is-size-3 has-text-white has-text-centered mb-5 has-text-weight-bold">Nosso objetivo</p>
                <p class="tamanho-fonte has-text-white">Estimular desenvolvedores para que melhorem seus conhecimentos e não percam seu foco</p>
                </article>
            </div>
        </div>

        <nav class="level reset-level" style="background-color:#5333A5;padding-bottom: 2rem;">
            <div class="level-left has-text-white">
                <div class="level-item">
                    <img src="{{ url('images/logo.png') }}" class="logo">
                </div>
                <div class="level-item">
                    <h1 class="is-size-3 has-text-weight-bold">Improov</h1>
                </div>
            </div>

            <div class="level-right has-text-white">
                <div class="level-item mx-5">
                    <a href="#" class="is-size-4 has-text-weight-bold">Fale conosco</a>
                </div>
                <div class="level-item mx-5">
                    <a href="#" class="is-size-4 has-text-weight-bold">Ajuda</a>
                </div>
            </div>
        </nav>
        
    </body>
</html>
