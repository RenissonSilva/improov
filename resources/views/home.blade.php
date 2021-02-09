@extends('layouts.home')

@section('content')
<style>

</style>
<div class="container-default">
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
    <div class="row justify-content-around mt-5" style="height:904px;border:1px solid black">
        <div class="col-6" style="border:1px solid black;">
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
                {{-- <img src="{{ Auth::user()->image }}" class="imagem imagem2"></img>
                <img src="{{ Auth::user()->image }}" class="imagem imagem2"></img>
                <img src="{{ Auth::user()->image }}" class="imagem imagem3"></img>
                <img src="{{ Auth::user()->image }}" class="imagem imagem4"></img> --}}
            </div>
        </div>
    </div>
</div>
@endsection
