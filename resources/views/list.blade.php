@extends('layouts.home')

@section('content')
    <div class="container-default">
        <div class="row mb-0">
            <h3 class="col-9 menu-title"><i class="icon-title far fa-folder"></i>Meus projetos</h3>
            <p>Última atualização feita em {{ $last_update->format('d/m/Y - H:m') }}</p>
        </div>
        <p class="sub-title">Clique na estrela para escolher seus projetos favoritos (máximo 3)</p>
        <div class="row">
            @foreach($github_repo as $repo)
            @php ($repo->main_language) ? $url_image = "images/languages/$repo->main_language.png" : $url_image = "images/languages/default.png"; @endphp
            <div class="col-md-6">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-margin-{{$repo->main_language}} card-repo h-160">
                    <div class="row nm-row h-100">
                        <div>
                            <img src="{{ url($url_image) }}" class="circle responsive-img repo-language">
                        </div>
                        <div class="col-md-9 name-star">
                            <div>
                                <span class="repo-title">
                                    {{ $repo->name }}
                                </span>
                                <a href="#" class="primary-content fr"><i class="material-icons star repo-favorite">grade</i></a>
                            </div>
                            <div class="right-align div-btn-github">
                                <a class="waves-effect waves-light btn modal-trigger btn-default btn-github" href="{{ $repo->link }}" target="_blank">Ver no github</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection