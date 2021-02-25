@extends('layouts.home')

@section('content')
    <div class="container-default">
        <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-bullseye icon-title"></i>Minhas missões</h3>
            <a class="col waves-effect waves-light btn modal-trigger btn-default btn-mission" href="#modal-create-mission">Criar missão</a>
        </div>
        <div class="row">
            <div class="col s12 np">
                <div class="card darken-1">
                    <table class="highlight centered missions_list">
                        <tbody>
                            @if($my_missions->isEmpty())
                            <b class="text-center my-5 grey-text h4">Nenhuma missão criada</b>
                            @endif
                            @foreach($my_missions as $mission)
                            <tr>
                                
                                <th>
                                    <span class="new badge mr-3 {{ ($mission->is_active == 1) ? 'badge-ativa' : 'badge-inativa' }}" data-badge-caption="">{{ ($mission->is_active == 1) ? 'ATIVA' : 'INATIVA' }}</span>
                                    <span class="mission_name">{{ $mission->name }}</span>
                                </th>
                                <th class="right-align">
                                    <button class="btn-floating btn modal-trigger mr-2 newpurple tooltipped" data-position="top" 
                                            data-html="true" data-tooltip="Editar" onclick="modalEditMission(this)" 
                                        href="#modal-edit-mission" id="{{ $mission->id }}"><i class="material-icons">edit</i>
                                    </button>
                                    <button class="btn-floating btn red modal-trigger tooltipped" data-position="top" 
                                        data-html="true" data-tooltip="Excluir" onclick="modalRemoveMission(this)" href="#modal-delete-mission" id="{{ $mission->id }}"><i class="material-icons">delete</i>
                                    </button>
                                </th>
                            </tr>
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
                console.log(result.is_active);
                $("#id_edit").val(result.id);
                $("#name_edit").val(result.name);
                $("#name_edit").focus();
                $(`#status_mission option[value=${result.is_active}]`).attr('selected','selected');
                $('#status_mission').formSelect();
            },
            error: function (res) {
                console.log(res);
                console.log('Ocorreu algum erro');
            }
        });

        return false;
    }

    function modalRemoveMission(data) {
        var id = data.id;
        var action = 'mission/delete/'+id;

        $('#form-delete').attr('action', action);
    }
</script>
@endsection