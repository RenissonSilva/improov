@extends('layouts.home')

@section('content')
<style>

</style>
<div class="container-default" style="padding-left:50px;padding-right:50px;">
    <div class="row">
        <h3 class="col-9 menu-title"><i class="fas fa-check-double icon-title"></i>Missões diárias</h3>
        <h3 class="col menu-title grey-text text-darken-1 right-align">{{ $completed_missions }}/2</h3>
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
    <div class="row justify-content-around mt-5" style="height:1004px;">
        <div class="col-6">
            <div class="tituloProjetoFavorito">
                <img src="{{ url('images/vector.png') }}" class="vector">
                <h3 class="textoProjetoFavorito">Projetos Favoritos</h3>
            </div>

            @foreach($favorites_repositories as $fav_repo)
            <h5>{{ $fav_repo->name }}</h5>
            @endforeach

            <div class="boxProjetoFavorito">
                <div class="retanguloCor"></div>
                <div class="conteudoBoxProjetoFavorito">
                    <div class="headerBoxConteudo">
                        <img class="imagemBoxHeader" src="{{ Auth::user()->image }}" alt="">
                        <h4 class="textoBoxHeader">Calculadora em JavaScript</h4>
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
                        <button class="btnBodyBoxConteudo">Ver mais</button>
                    </div>
                </div>
            </div>
            <div class="boxProjetoFavorito">
                <div class="retanguloCor"></div>
                <div class="conteudoBoxProjetoFavorito">
                    <div class="headerBoxConteudo">
                        <img class="imagemBoxHeader" src="{{ Auth::user()->image }}" alt="">
                        <h4 class="textoBoxHeader">Calculadora em JavaScript</h4>
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
                        <button class="btnBodyBoxConteudo">Ver mais</button>
                    </div>
                </div>
            </div>
            <div class="boxProjetoFavorito">
                <div class="retanguloCor"></div>
                <div class="conteudoBoxProjetoFavorito">
                    <div class="headerBoxConteudo">
                        <img class="imagemBoxHeader" src="{{ Auth::user()->image }}" alt="">
                        <h4 class="textoBoxHeader">Calculadora em JavaScript</h4>
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
                        <button class="btnBodyBoxConteudo">Ver mais</button>
                    </div>
                </div>
            </div>
            <div class="boxProjetoFavorito">
                <div class="retanguloCor"></div>
                <div class="conteudoBoxProjetoFavorito">
                    <div class="headerBoxConteudo">
                        <img class="imagemBoxHeader" src="{{ Auth::user()->image }}" alt="">
                        <h4 class="textoBoxHeader">Calculadora em JavaScript</h4>
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
                        <button class="btnBodyBoxConteudo">Ver mais</button>
                    </div>
                </div>
            </div>
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
