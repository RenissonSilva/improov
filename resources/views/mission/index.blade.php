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
            <div class="col s12 np">
                <div class="card darken-1">
                    <table id="paginate-missao-pendente" class="highlight centered missions_list">
                       @include('component-missionPendente',$my_missions)
                    </table>
                </div>
                @component('component.paginate',['variavel'=>$my_missions,
                                                 'classLi' => 'paginatePendente','classA' => 'linkPaginatePendente'])
                @endcomponent
            </div>
        </div>

        {{-- Missões Concluídas --}}
         <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-check-circle icon-title"></i>Missões concluídas</h3>
        </div>
        <div class="row">
            <div class="col s12 np" id="miss-conclu">
                <div class="card darken-1">
                    <table id="paginate-missao-concluida" class="highlight centered missions_list">
                        @include('component-missionConcluida',$missoesConcluidas)
                    </table>
                </div>
                @component('component.paginate',['variavel'=>$missoesConcluidas, 'idPagination'=>'pagi-conclu',
                                                 'classLi' => 'paginateConcluida','classA' => 'linkPaginateConcluida'])
                @endcomponent
            </div>
        </div>
    </div>
    @include('layouts.modal-missions')
    @include('layouts.toastr-message')
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                    $('#tbody-mission-pendente').append("<tr id='tr-" + id +
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
                            quantidadeTr = $('#tbody-mission-concluida tr').length;
                            if(quantidadeTr < 3){
                                mensagem = result.criador == null ? 'Missão do sistema' : 'Missão criada pelo usuário';

                                data = new Date(result.updated_at).toLocaleDateString('pt-BR', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute:'2-digit',
                                });

                                $('#nenhuma-mission-criada').remove();

                                inicioTr = "<tr id='tr-"+id+"'>";
                                inicioTh = "<th style='padding:9px 20px !important'>";
                                inicioSpan = "<span id='mission_name-"+id+"'class='mission_name'>";
                                inicioDiv = "<div data-tooltip='"+mensagem+"' data-position='top' data-html='true' class='waves-effect waves-light tooltipped'>"
                                icone = result.criador == null ? "<i class='fa fa-cog fa-xs tooltiped' style='margin-right:8px'></i>" : "<i class='fa fa-user-circle fa-xs tooltiped' style='margin-right:8px'></i>";
                                inicioFechamento = "</div>"+result.name+"</span></th>";
                                fimFechamento = "<th class='right-align' style='font-size: 14px;color:#565656'>Data de conclusão: "+data+"</th></tr>";
                                $('#tbody-mission-concluida').append(inicioTr+inicioTh+inicioSpan+inicioDiv+icone+inicioFechamento+fimFechamento);
                            }else{

                                isNotPaginacao = $('#pagi-conclu').length > 0 ? false : true;
                                console.log(isNotPaginacao);
                                if(isNotPaginacao){
                                    urlPaginate = document.URL+"/ajaxconcluida";
                                    inicioUl = "<ul class='pagination' id='pagi-conclu' style='display:flex;justify-content:flex-end'>";
                                    anterior = "<li class='paginateConcluida disabled'><a class='linkPaginateConcluida' href='"+urlPaginate+"?page=1'>Anterior</a></li>";
                                    numberUm = "<li class='paginateConcluida active'><a class='linkPaginateConcluida' href='"+urlPaginate+"?page=1'>1</a></li>";
                                    numberdois = "<li class='paginateConcluida'><a class='linkPaginateConcluida' href='"+urlPaginate+"?page=2'>2</a></li>";
                                    proximo = "<li class='paginateConcluida'><a class='linkPaginateConcluida' href='"+urlPaginate+"?page=2'>Próximo</a></li>";
                                    fimUl = "</ul>";

                                    $('#miss-conclu').append(inicioUl+anterior+numberUm+numberdois+proximo+fimUl);
                                }
                            }
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
            var tipo = $(this).attr('data-tipo');
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
                    'is_active': is_active,
                    'tipo': tipo
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
                console.lo
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
