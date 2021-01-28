@extends('layouts.home')

@section('content')
    <div class="container-default">
        <div class="row" style="margin-bottom:0;">
            <h3 class="col-9 menu-title"><i class="icon-title far fa-folder"></i>Meus projetos</h3>
        </div>
        <p class="sub-title">Clique na estrela para escolher seus projetos favoritos (máximo 3)</p>

        <div class="row">
            @foreach($github_repo as $repo)
            <div class="col-md-6">
                <div class="card-panel grey lighten-5 z-depth-1">
                    <div class="row nm-row">
                        <div>
                            <img src="{{ url('images/languages/js.png') }}" class="circle responsive-img repo-language">
                        </div>
                        <div class="col-md-9">
                            <span class="repo-title">
                                {{ $repo->name }} - {{ $repo->language }}
                            </span>
                        </div>
                        <div class="col-md-1">
                            <a href="#!" class="primary-content"><i class="material-icons star">grade</i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
