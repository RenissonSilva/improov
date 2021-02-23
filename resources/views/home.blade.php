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
            @foreach($my_missions as $mission)
            <tr class="row">
                <td class="col-8 mission-text">{{$mission}}</td>
                <td class="col valign-wrapper">
                    <div class="progress">
                        @if ($loop->first)
                        <div class="determinate" style="width: {{ $progress_of_missions[0] }}%;"></div>
                        @else
                        <div class="determinate" style="width: {{ $progress_of_missions[1] }}%;"></div>
                        @endif
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row justify-content-around mt-5" style="height:900px;margin-bottom:90px">
        <div class="col-6">
            <div class="tituloProjetoFavorito">
                <h3 class="col-9 menu-title"><i class="fas fa-folder icon-title"></i>Projetos Favoritos</h3>
            </div>

            @foreach($favorites_repositories as $fav_repo)
            @php ($fav_repo->main_language) ? $url_image = "images/languages/$fav_repo->main_language.png" : $url_image = "images/languages/default.png"; @endphp

            <div class="boxProjetoFavorito">
                <div class="retanguloCor"></div>
                <div class="conteudoBoxProjetoFavorito">
                    <div class="headerBoxConteudo">
                        <img class="imagemBoxHeader" src="{{ url($url_image) }}" alt="">
                        <h4 class="textoBoxHeader">{{$fav_repo->name}}</h4>
                    </div>
                    <div class="bodyBoxConteudo">
                        <div class="commits">
                            <div class="textoBodyBoxConteudo">
                                Commits nos últimos dias
                            </div>
                            <div class="bolasCommitsBodyBox">
                                <div class="bolaBodyBox bola1"></div>
                                <div class="bolaBodyBox bola2"></div>
                                <div class="bolaBodyBox bola3"></div>
                                <div class="bolaBodyBox bola4"></div>
                                <div class="bolaBodyBox bola5"></div>
                                <div class="bolaBodyBox bola6"></div>
                                <div class="bolaBodyBox bola7"></div>
                                <div class="bolaBodyBox bola8"></div>
                                <div class="bolaBodyBox bola9"></div>
                                <div class="bolaBodyBox bola10"></div>
                            </div>
                        </div>
                        <button class="btnBodyBoxConteudo" style="margin-top: 15px;margin-left: 87px;"><a target="_blank" href="{{$fav_repo->link}}" style="color:white;text-decoration:none">Ver mais</a></button>
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
