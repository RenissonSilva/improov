@extends('layouts.home')

@section('content')
<style>

</style>
<div class="container-default">
    <div class="row">
        <h3 class="col-9 menu-title"><i class="fas fa-check icon-title"></i>Missões diárias</h3>
        <h3 class="col menu-title grey-text text-darken-1 right-align">{{ $completed_missions }}/{{ $total_missions }}</h3>
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
                <td class="col-8 mission-text">{{$mission->name}}</td>
                <td class="col valign-wrapper">
                    <div class="progress">
                        @if ($loop->first)
                        <div class="determinate" style="width: {{ $progress_of_missions[0] }}%;"></div>
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
        <div class="col-6 np">
            <div class="tituloProjetoFavorito">
                <h3 class="col-12 menu-title"><i class="fas fa-folder icon-title"></i>Projetos Favoritos</h3>
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
            <div class="col-md-12">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-margin-{{$fav_repo->main_language}} card-repo h-160">
                    <div class="row nm-row h-100">
                        <div>
                            <img src="{{ url($url_image) }}" class="circle responsive-img repo-language">
                        </div>
                        <div class="col-md-8 name-star">
                            <div>
                                <span class="repo-title">
                                    {{ $fav_repo->name }}
                                </span>
                            </div>
                            <div class="right-align div-btn-github">
                                <a class="waves-effect waves-light btn modal-trigger btn-default btn-github" href="{{ $fav_repo->link }}" target="_blank">Ver no github</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-6 backgroundRankingSemanal">
            <h3 class="tituloRankingSemanal">Ranking Semanal <img class="imgTituloRankingSemanal"src="{{ url('images/premio.png') }}"></span></h3>
            <div class="backSelect">
                <button class="buttonSelectedRankingSemanal buttonsRankingSemanal">Amigos</button>
                <button class="buttonsRankingSemanal" style="background:#5333A5;border-radius:5px;">Geral</button>
                <img src="{{ Auth::user()->image }}" class="imagem imagem1">
                <img src="{{ url('images/coroa.png') }}" class="coroa">
                <div class="backPremiacao premiacaoFirst">1</div>
                <h4 class="textoRankingPremiacao textoFirst">Erickson Ferreira</h4>
                <div class="section3">
                    <div class="col">
                        <img src="{{ Auth::user()->image }}" class="imagem imagem2"></img>
                        <div class="backPremiacao premiacaoSecond">2</div>
                        <h4 class="textoRankingPremiacao textoSecond">Erickson Ferreira</h4>
                    </div>
                    <div class="col">
                        <img src="{{ Auth::user()->image }}" class="imagem imagem2"></img>
                        <div class="backPremiacao premiacaoThird">3</div>
                        <h4 class="textoRankingPremiacao textoThird">Erickson Ferreira</h4>
                    </div>
                </div>
                <div class="section4" style="margin-top: 10px;">
                    <div class="FinalPremiacao">4</div>
                    <img src="{{ Auth::user()->image }}" class="imagem imagem3"></img>
                    <h4 class="textoRanking">Erickson Ferreira</h4>
                </div>
                <hr style=" background: #A37EFF; height: 2px;">
                <div class="section4">
                    <div class="FinalPremiacao">5</div>
                    <img src="{{ Auth::user()->image }}" class="imagem imagem3"></img>
                    <h4 class="textoRanking">Erickson Ferreira</h4>
                </div>
                {{-- <img src="{{ Auth::user()->image }}" class="imagem imagem3"></img>
                <img src="{{ Auth::user()->image }}" class="imagem imagem4"></img> --}}
            </div>
        </div>
    </div>
</div>
@endsection
