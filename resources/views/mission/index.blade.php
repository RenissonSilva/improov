@extends('layouts.home')

@section('content')
    <style>
        .pagination li.active {
            background-color: #8B64EC;
        }

    </style>

    <div class="container-default">

        {{-- Missões pendentes --}}
        <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-clock icon-title"></i>Missões pendentes</h3>
            <a class="col waves-effect waves-light btn modal-trigger btn-default btn-mission" id="btn-create-mission"
                href="#modal-create-mission">Criar missão</a>
        </div>
        <div class="row">
            {{-- <form method="post" action="{{route('teste')}}">
                @csrf
                <input type="submit" value="enviar">
            </form> --}}
            <div class="col s12 np">
                <div class="card darken-1">
                    <table id="paginate-missao-pendente" class="highlight centered missions_list">
                       @include('component-missionPendente',$my_missions)
                    </table>
                </div>
                @if ($my_missions->lastPage() > 1)
                    <ul class="pagination" style="display:flex;justify-content:flex-end">
                        <li class="paginatePendente {{ $my_missions->currentPage() == 1 ? ' disabled' : '' }}">
                            <a class="linkPaginatePendente" href="{{ $my_missions->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $my_missions->lastPage(); $i++)
                            <li class="paginatePendente {{ $my_missions->currentPage() == $i ? ' active' : '' }}">
                                <a class="linkPaginatePendente" href="{{ $my_missions->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginatePendente {{ $my_missions->currentPage() == $my_missions->lastPage() ? ' disabled' : '' }}">
                            <a class="linkPaginatePendente" href="{{ $my_missions->url($my_missions->currentPage() + 1) }}">Próximo</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
         {{-- Missões Concluídas --}}
         <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-check-circle icon-title"></i>Missões concluídas</h3>
        </div>
        <div class="row">
            <div class="col s12 np">
                <div class="card darken-1">
                    <table id="paginate-missao-concluida" class="highlight centered missions_list">
                        @include('component-missionConcluida',$missoesConcluidas)
                    </table>
                </div>
                @if ($missoesConcluidas->lastPage() > 1)
                    <ul class="pagination" style="display:flex;justify-content:flex-end">
                        <li class="paginateConcluida {{ $missoesConcluidas->currentPage() == 1 ? ' disabled' : '' }}">
                            <a class="linkPaginateConcluida" href="{{ $missoesConcluidas->url(1) }}">Anterior</a>
                        </li>
                        @for ($i = 1; $i <= $missoesConcluidas->lastPage(); $i++)
                            <li class="paginateConcluida {{ $missoesConcluidas->currentPage() == $i ? ' active' : '' }}">
                                <a class="linkPaginateConcluida" href="{{ $missoesConcluidas->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="paginateConcluida {{ $missoesConcluidas->currentPage() == $missoesConcluidas->lastPage() ? ' disabled' : '' }}">
                            <a class="linkPaginateConcluida" href="{{ $missoesConcluidas->url($missoesConcluidas->currentPage() + 1) }}">Próximo</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.modal-missions')
    @include('layouts.toastr-message')
@endsection

@section('scripts')
    <script>
        function criarMissao() {
            action = "{{ route('mission.store') }}"
        }
        $('#form-delete').submit(function(e) {
            e.preventDefault();
            const id = $('input[name="id_delete"]').val();
            url = "{!! url('user/mission/delete/"+id+"') !!}";
            disableBtnDel = $('#btn-del').attr('disabled', 'disabled');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function(response) {
                    $('#tr-' + id).hide();
                    $('.modal').modal('close');
                    disableBtnDel = $('#btn-del').attr('disabled', false);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    disableBtnDel = $('#btn-del').attr('disabled', false);

                }
            });
        });

        $('#criar-missao').submit(function(e) {
            e.preventDefault();
            const nome = $('input[name="name"]').val();
            const repeat_mission = $('.repeat_mission').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('mission.store') }}", // caminho para o script que vai processar os dados
                type: 'POST',
                data: {
                    name: nome,
                    repeat_mission: repeat_mission
                },
                success: function(id) {
                    $('#mission_name-' + id).html(nome);
                    $('#name').val('');
                    $('tbody').append("<tr id='tr-" + id +
                        "'><th class='row nm th-switch valign-wrapper'><div class='switch'><label><input id='" +
                        id +
                        "' class='toggle-mission' type='checkbox' checked=''><span class='lever'></span></label></div><span id='mission_name-" +
                        id + "' class='mission_name'>" + nome +
                        "</span></th> <th class='right-align'><button class='btn-floating btn mr-2 newpgreen tooltipped' data-position='top' data-html='true' data-tooltip='Concluída' onclick='missaoConcluida(" +
                        id + ")' id='m" + id +
                        "'><i class='material-icons'>check</i></button><button class='btn-floating btn modal-trigger mr-2 newpurple tooltipped' data-position='top' data-html='true' data-tooltip='Editar' onclick='modalEditMission(this)' href='#modal-edit-mission' id='" +
                        id +
                        "' data-name='testasdf'><i class='material-icons'>edit</i></button><button class='btn-floating btn newred modal-trigger tooltipped' data-position='top' data-html='true' data-tooltip='Excluir' data-id='" +
                        id +
                        "' onclick='modalRemoveMission(this)' href='#modal-delete-mission' id='30'><i class='material-icons'>delete</i></button></th>"
                        );
                    $('.modal').modal('close');
                    disableBtnDel = $('#btn-del').attr('disabled', false);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    disableBtnDel = $('#btn-del').attr('disabled', false);
                }
            });
        });
        $('#editar-missao').submit(function(e) {
            e.preventDefault();
            const nome = $('input[name="name_edit"]').val();
            const repeat_mission = $('#repeat_mission_edit').val();
            const id = $('input[name="id_edit"]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('mission.update') }}", // caminho para o script que vai processar os dados
                type: 'PUT',
                data: {
                    name_edit: nome,
                    repeat_mission: repeat_mission,
                    id_edit: id
                },
                success: function(response) {
                    $('#mission_name-' + id).html(nome);
                    $('.modal').modal('close');
                    disableBtnDel = $('#btn-del').attr('disabled', false);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    disableBtnDel = $('#btn-del').attr('disabled', false);
                }
            });
        });

        function missaoConcluida(id) {
            $('#' + id).prop('checked', false);
            $("#m" + id).attr('disabled', 'disabled');
            toastr.success('Missão concluída com sucesso!')


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "get",
                url: 'mission/modifiedCompletedMission/' + id,
                dataType: 'json',
                success: function(r) {

                    is_active = false;
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "post",
                        url: "mission/change",
                        dataType: 'json',
                        data: {
                            'id': id,
                            'is_active': is_active
                        },
                        success: function(result) {

                        }
                    });


                },
                error: function(res) {
                    $("#m" + id).attr('disabled', false);
                    $('#' + id).prop('checked', true);
                    console.log(res);
                    console.log('Ocorreu algum erro');
                }
            });
        }

        function modalEditMission(data) {
            $id = data.id;
            $("#name_edit").val($("#mission_name-" + $id).html());
            $(".repeat_mission").val($("#repeat_mission-" + $id).val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "mission/edit",
                dataType: 'json',
                data: {
                    'id': $id
                },
                success: function(result) {
                    $("#id_edit").val(result.id);
                    $("#name_edit").focus();
                    $(`.status_mission`).val(result.is_active);
                    $(`.repeat_mission`).val(result.repeat_mission ?? 0);
                    $('.repeat_mission').formSelect();
                    $(`#id-edit`).val($id);
                },
                error: function(res) {
                    console.log(res);
                    console.log('Ocorreu algum erro');
                }
            });

            return false;
        }

        $('.toggle-mission').on('change', function(e) {
            var id = this.id;
            var is_active = this.checked;
            if (is_active == true) {
                toastr.success('Missão ativada com sucesso!')
                $("#m" + id).attr('disabled', false);
            } else {
                toastr.success('Missão desativada com sucesso!')
                $("#m" + id).attr('disabled', true);
                $('.repeat_mission').formSelect();
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: "mission/change",
                dataType: 'json',
                data: {
                    'id': id,
                    'is_active': is_active
                },
                success: function(result) {},
                error: function(res) {
                    if (is_active == false) {
                        toastr.success('Missão ativada com sucesso!')
                        $("#m" + id).attr('disabled', false);
                    } else {
                        toastr.success('Missão desativada com sucesso!')
                        $("#m" + id).attr('disabled', true);
                        $('.repeat_mission').formSelect();
                    }
                    console.log(res);
                    console.log('Ocorreu algum erro');
                }
            });
        });

        $('#btn-create-mission').on('click', function(e) {
            $(`.status_mission`).val('0');
            $(".repeat_mission").val('0');
            $('.repeat_mission').formSelect();
        });

        function modalRemoveMission(data) {
            var id = $(data).data("id");

            // var action = 'mission/delete/'+id;

            // $('#form-delete').attr('action', action);
            $('#btn-del').attr('disabled', false);
            $('#id_delete').val(id);
        }
        // $('.lever').click(console.log);
        $('.linkPaginatePendente').on('click', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            complementoUrl = url.split("?");
            complementoUrl[0] = complementoUrl[0]+"/ajaxpendente?";
            url = complementoUrl[0]+complementoUrl[1];

            $('.paginatePendente').removeClass('active');
            $(this).parent().addClass('active');

            valor = complementoUrl[1].split('=');
            valor[1];

            missaoPendente = $('#paginate-missao-pendente').html();

            $.get(url, null, function(data){

                $('#paginate-missao-pendente').html(data);
            });
        });

        $('.linkPaginateConcluida').on('click', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            complementoUrl = url.split("?");
            complementoUrl[0] = complementoUrl[0]+"/ajaxconcluida?";
            url = complementoUrl[0]+complementoUrl[1];

            $('.paginateConcluida').removeClass('active');
            $(this).parent().addClass('active');

            valor = complementoUrl[1].split('=');
            valor[1];
            $.get(url, null, function(data){

                $('#paginate-missao-concluida').html(data);
            });
        });

    </script>
@endsection
