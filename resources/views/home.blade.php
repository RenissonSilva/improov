@extends('layouts.home')

@section('content')
<style>
    @media screen and (max-width:1200px){
        /* .dropdown-home-layout{
            width:200px;
            height::auto;
        } */
        .simple_link{
            display: none;
        }
        #navbarSupportedContent{
            display:block;
            z-index:1;
            width:10px;
        }
        .dropdown-home-layout{
            font-size:10px;
        }

        .avatar{
            width: 127px;
            border-radius: 100%;
        }
        .navbar{
            justify-content: end;
        }
        .card-panel{
            width: 100%;
        }
        .name-star{
            height: 0px;
        }
        .row > .menu-title{
            margin-top:40px;
            margin-bottom:0px;
        }
        .mission-title{
            font-size:24px;
        }
        .mission-text{
            font-size:16px;
        }
        .btn-github{
            font-size:14px !important;
        }
        .repo-language{
            width: 8% !important;
            height: 70%!important;
        }
        .repo-title{
            font-size:17px;
        }
        .card-repo{
            height:80%;;
        }
    }
</style>
<div class="container-default">
    <div class="row">
        <h3 class="col-12 menu-title"><i class="fas fa-check icon-title"></i>Missões diárias</h3>
    </div>
    <table class="striped">
        <tbody>
            @if($my_missions->isEmpty())
            <div class="row">
                <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                        <b class="text-center my-5 grey-text h4">Nenhuma missão ativa</b>
                    </div>
                </div>
                </div>
            </div>
            @endif
            @foreach($my_missions as $mission)
            <tr class="row">

                <td class="col-8 mission-text" style="padding-left:13px !important">
                    <div data-tooltip="{{ $mission->criador == null ? "Missão do sistema" : "Missão criada pelo usuário" }}"
                        data-position="top" data-html="true" class="waves-effect waves-light tooltipped">
                        @if($mission->criador == null)
                            {{-- <i class="fa fa-cog fa-xs tooltiped" style="margin-right:8px"></i> --}}
                            <span class="badge" style="background-color:#8B64EC; color:white; margin-right:3px" > Level {{ $mission->level_mission }}</span>

                        @else
                            <i class="fa fa-user-circle fa-xs tooltiped" style="margin-right:8px"></i>
                        @endif
                    </div>
                    {{$mission->name}}
                </td>
                <td class="col valign-wrapper">
                    <div class="progress">
                        @if ($loop->first)
                        {{-- <div class="determinate" style="width: {{ $progress_of_missions[0] }}%;"></div> --}}
                        <div class="determinate" style="width: 0%;"></div>
                        @else
                        {{-- <div class="determinate" style="width: {{ $progress_of_missions[1] }}%;"></div> --}}
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row justify-content-around mt-5" style="height:900px;margin-bottom:90px">
        <div class="col-12 np">
            <div class="tituloProjetoFavorito">
                <h3 class="col-12 menu-title nmt"><i class="fas fa-folder icon-title"></i>Projetos Favoritos</h3>
            </div>
            @if($favorites_repositories->isEmpty())
            <div class="row">
                <div class="col s12 m6">
                <div class="card">
                    <div class="card-content">
                    <b class="text-center my-5 grey-text h4">Nenhum repositório favorito</b>

                    </div>
                </div>
                </div>
            </div>
            @endif
            @foreach($favorites_repositories as $fav_repo)
            @php ($fav_repo->main_language) ? $url_image = "images/languages/$fav_repo->main_language.png" : $url_image = "images/languages/default.png"; @endphp
            <div class="col-md-6">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-margin-{{$fav_repo->main_language}} card-repo h-160">
                    <div class="row nm-row h-100">
                        <div class="col-md-3">
                            <img src="{{ url($url_image) }}" class="circle responsive-img repo-language" style="min-width:80px;">
                        </div>
                        <div class="col-md-8 name-star np">
                            <div class="truncate-custom">
                                <span class="repo-title tooltipped" data-position="bottom" data-html="true" data-tooltip="{{ $fav_repo->name }}">
                                    {{ $fav_repo->name }}
                                </span>
                            </div>
                            <div class="right-align div-btn-github col np">
                                <a class="waves-effect waves-light btn modal-trigger btn-default btn-github" href="{{ $fav_repo->link }}" target="_blank">Ver no github</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-md-6">
                    <canvas id="chartProjectsTech" width="400" height="400"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="chartCommits" width="400" height="400"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
// var ctx = document.getElementById('chartProjectsTech').getContext('2d');
// var chartProjectsTech = new Chart(ctx, {
//     type: 'doughnut',
//     data: {
//         labels: [
//             'Laravel',
//             'React',
//             'JS'
//         ],
//         datasets: [{
//             label: 'Projetos por tecnologia',
//             data: [18, 5, 10],
//             backgroundColor: [
//             'rgb(255, 99, 132)',
//             'rgb(54, 162, 235)',
//             'rgb(255, 205, 86)'
//             ],
//             hoverOffset: 4
//         }]
//     },
//     options: {
//         plugins: {
//             title: {
//                 display: true,
//                 text: 'Projetos por tecnologia'
//             }
//         },
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

// var ctx = document.getElementById('chartCommits').getContext('2d');
// var chartCommits = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
//         datasets: [{
//             label: 'Nº de commits',
//             data: [65, 59, 80, 81, 56],
//             fill: false,
//             borderColor: 'rgb(75, 192, 192)',
//             tension: 0.1
//         }],
//         // options: {
//         //     plugins: {
//         //         title: {
//         //             display: true,
//         //             text: 'Projetos por tecnologia'
//         //         }
//         //     },
//         // }
// }
// });
</script>
@endsection
