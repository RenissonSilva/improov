@extends('layouts.home')

@section('content')
    <div class="container-default">
        <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-flag icon-title"></i>Minhas missões</h3>
            <a class="col waves-effect waves-light btn modal-trigger btn-default btn-mission" id="btn-create-mission" href="#modal-create-mission">Criar missão</a>
        </div>
        <div class="row">
            {{-- <form method="post" action="{{route('teste')}}">
                @csrf
                <input type="submit" value="enviar">
            </form> --}}
            <div class="col s12 np">
                <div class="card darken-1">
                    <table class="highlight centered missions_list">
                        <tbody>
                            @if($my_missions->isEmpty())
                            <b class="text-center my-5 grey-text h4">Nenhuma missão criada</b>
                            @endif
                            @foreach($my_missions as $mission)
                                @if($mission->level_mission == null || $mission->level_mission == Auth::user()->level )
                                <tr>
                                    <th class="row nm th-switch valign-wrapper">
                                        <div class="switch">
                                            <label>
                                            <input id="{{ $mission->id }}" class="toggle-mission" type="checkbox" {{ ($mission->is_active == 1) ? 'checked' : '' }}>
                                            <span class="lever"></span>
                                            </label>
                                        </div>
                                        <span class="mission_name">{{ $mission->name }}</span>
                                    </th>
                                    <th class="right-align">
                                        @if($mission->points == null)
                                            @if($mission->completed == 0)
                                                <button class="btn-floating btn mr-2 newpgreen tooltipped" data-position="top"
                                                        data-html="true" data-tooltip="Concluída" onclick="missaoConcluida({{ $mission->idMissionUser }})"
                                                        id="m{{ $mission->idMissionUser }}"><i class="material-icons">check</i>
                                                </button>
                                            @endif
                                            <button class="btn-floating btn modal-trigger mr-2 newpurple tooltipped" data-position="top"
                                                data-html="true" data-tooltip="Editar" onclick="modalEditMission(this)"
                                                href="#modal-edit-mission" id="{{ $mission->id }}"><i class="material-icons">edit</i>
                                            </button>
                                            <button class="btn-floating btn newred modal-trigger tooltipped" data-position="top"
                                                data-html="true" data-tooltip="Excluir" data-id="{{ $mission->id }}" onclick="modalRemoveMission(this)" href="#modal-delete-mission" id="{{ $mission->idMissionUser }}"><i class="material-icons">delete</i>
                                            </button>
                                        @endif
                                    </th>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.modal-missions')
    @include('layouts.toastr-message')
@endsection

@section('scripts')
<script>
    function missaoConcluida(id) {

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.ajax({
            type: "post",
            url: 'mission/modifiedCompletedMission/',
            dataType: 'json',
            data: {'id' : id},
            success: function (result) {
                // console.log(result);
                $("#m"+id).hide();
                // $("#name_edit").val(result.name);
                // $("#name_edit").focus();
                // $(`#status_mission option[value=${result.is_active}]`).attr('selected','selected');
                // $('#status_mission').formSelect();
            },
            error: function (res) {
                console.log(res);
                console.log('Ocorreu algum erro');
            }
        });
    }
    function modalEditMission(data) {
        $id = data.id;

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.ajax({
            type: "post",
            url: "mission/edit",
            dataType: 'json',
            data: {'id' : $id},
            success: function (result) {
                $("#id_edit").val(result.id);
                $("#name_edit").val(result.name);
                $("#name_edit").focus();
                $(`.status_mission`).val(result.is_active);
                $('.status_mission').formSelect();

                $(`.repeat_mission`).val(result.repeat_mission ?? 0);

                if(result.is_active == 1){
                    $(".repeat_mission").attr('disabled',false);
                    $('.repeat_mission').formSelect();
                }else{
                    $(".repeat_mission").attr('disabled',true);
                    $('.repeat_mission').formSelect();
                }
            },
            error: function (res) {
                console.log(res);
                console.log('Ocorreu algum erro');
            }
        });

        return false;
    }

    $('.toggle-mission').on('change', function (e) {
        var id = this.id;
        var is_active = this.checked;

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        $.ajax({
            type: "post",
            url: "mission/change",
            dataType: 'json',
            data: {'id' : id, 'is_active': is_active},
            success: function (result) {
                console.log(is_active);
                if(is_active == true){
                    toastr.success('Missão ativada com sucesso!')
                }else{
                    toastr.success('Missão inativada com sucesso!')
                }
            },
            error: function (res) {
                console.log(res);
                console.log('Ocorreu algum erro');
            }
        });

        return false;
    });

    $('.status_mission').on('change', function (e) {
        var value = this.value;

        if(value == 1){
            $(".repeat_mission").attr('disabled',false);
            $('.repeat_mission').formSelect();
        }else{
            $(".repeat_mission").attr('disabled',true);
            $('.repeat_mission').formSelect();
        }
    });

    $('#btn-create-mission').on('click', function (e) {
        $(`.status_mission`).val('0');
        $(".repeat_mission").val('0');
        $(".repeat_mission").attr('disabled',true);
        $('.repeat_mission').formSelect();
    });

    function modalRemoveMission(data) {
        var id = $(data).data("id");

        var action = 'mission/delete/'+id;

        $('#form-delete').attr('action', action);
    }
</script>
@endsection
