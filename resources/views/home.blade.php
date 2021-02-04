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
    <div class="row justify-content-around mt-5">
        <div class="col-6" style="border:1px solid black;">
        </div>
        <div class="col-6 ranking" style="border:1px solid black">
            <div class="row justify-content-md-center">
                <h5>Ranking Semanal</h5>
            </div>
            <div class="row justify-content-md-center">
                <a href="#" class="col-2">Amigos</a>
                <a href="#" class="col-2">Geral</a>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-5">
                    <!-- <h4>1</h4> -->
                    <img src="{{ Auth::user()->image }}" class="imagem imagem1" alt="primeiro colocado">
                    <p class="texto-ranking">Exterminador do Futuro</p>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col col-lg-5">
                    <!-- <h4>2</h4> -->
                    <img src="{{ Auth::user()->image }}" class="imagem imagem2" alt="segundo colocado">
                    <p class="texto-ranking">Lili</p>
                </div>
                <div class="col col-lg-5">
                    <!-- <h4>3</h4> -->
                    <img src="{{ Auth::user()->image }}" class="imagem imagem2" alt="terceiro colocado">
                    <p class="texto-ranking">Allan</p>
                </div>
            </div>
            <!-- <div class="row"> -->
            <div class="person3 row">
                <h4>4</h4>
                <img src="{{ Auth::user()->image }}" class="imagem imagem3" alt="quarto colocado">
                <p class="texto-ranking-3">EltonZera</p>
            </div>
            <!-- </div> -->
            <hr>
            <div class="person3 row align-middle">
                <h4>5</h4>
                <img src="{{ Auth::user()->image }}" class="imagem imagem3" alt="quinto colocado">
                <p class="texto-ranking-3">Nem programo mizera</p>
            </div>
        </div>
    </div>
</div>
@endsection