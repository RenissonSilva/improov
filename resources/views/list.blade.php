@extends('layouts.home')

@section('content')
<style>

</style>
    <div class="container-default">
        <div class="row mb-0">
            <h3 class="col-12 menu-title"><i class="icon-title far fa-folder"></i>Meus projetos <i class="fas fa-sync-alt tooltipped update-icon" data-position="bottom" data-html="true" data-tooltip="Atualização é feita a cada 24h<br><br>Última realizada em {{ $last_update->format('d/m/Y - H:m') }}"></i></h3>
        </div>
        <p class="sub-title">Clique na estrela para escolher seus projetos favoritos (máximo 3)</p>
        <div class="row">
            @foreach($github_repo as $repo)
            @php ($repo->main_language) ? $url_image = "images/languages/$repo->main_language.png" : $url_image = "images/languages/default.png"; @endphp
            <div class="col-md-6">
                <div class="card-panel grey lighten-5 z-depth-1 card-margin-default card-margin-{{$repo->main_language}} card-repo h-160">
                    <div class="row nm-row h-100">
                        <div class="col-md-3">
                            <img src="{{ url($url_image) }}" class="circle responsive-img repo-language" style="min-width:80px;">
                        </div>
                        <div class="col-md-9 name-star np">
                            <div class="truncate-custom">
                                <span class="repo-title tooltipped" data-position="bottom" data-html="true" data-tooltip="{{ $repo->name }}">
                                    {{ $repo->name }}
                                </span>
                                <label class="right">
                                    <input type="checkbox" name="fav_repositories"
                                    id="{{ $repo->id }}" {{ ($repo->favorite == 1) ? 'checked' : '' }}/>
                                    <span id="span{{ $repo->id }}" class="{{ ($repo->favorite == 1) ? 'star' : 'apagada' }}"></span>
                                </label>
                            </div>
                            <div class="right-align div-btn-github col np">
                                <a class="waves-effect waves-light btn modal-trigger btn-default btn-github" href="{{ $repo->link }}" target="_blank">Ver no github</a>
                            </div>
                        </div>
                        <!--
                        star-bolder
                        star
                        -->
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
<script>
    $( document ).ready(function() {

        $("input[name=fav_repositories]").click(function(e){
            id = this.id;
            checked = this.checked;
            if($('input[name="fav_repositories"]:checked').length >3){
                e.preventDefault();
            };
            if($('#span'+id).hasClass('star')){
                e.preventDefault();
            }
            console.log(id);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
            $.ajax({
                type: "post",
                url: "addrepo",
                dataType: 'json',
                data: {'id': id, 'checked': checked},
                success: function (res) {
                    if(res.status === 'success') {
                        if(res.checked == "true"){
                            toastr.success('Adicionado aos favoritos com sucesso!')
                            $('#span'+id).removeClass('apagada');
                            $('#span'+id).addClass('star');
                            $('#'+id).attr('checked','checked');
                        }else{
                            toastr.success('Removido dos favoritos com sucesso!')
                            $('#span'+id).removeClass('star');
                            $('#span'+id).addClass('apagada');
                            $('#'+id).removeAttr('checked');
                        }
                    } else {
                        toastr.error('Você já tem 3 repositórios favoritos')
                    }
                },
                error: function (res) {
                    toastr.error('Não foi possível adicionar/remover o repositório')
                }
            });
        });


    });
</script>
@endsection
