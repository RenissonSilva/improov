@extends('layouts.home')

@section('content')
    <div class="container-default">
        <div class="row">
            <h3 class="col-9 menu-title"><i class="fas fa-list-ul icon-title"></i>Minhas missões</h3>
            <a class="waves-effect waves-light btn modal-trigger btn-default btn-mission" href="#modal-create-mission">Criar uma missão</a>
        </div>
        <div class="row">
            <div class="col s12 m6">
                <div class="card darken-1">
                    <table class="highlight centered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($my_missions as $mission)
                            <tr>
                                <th>{{ $mission->name }}</th>
                                <th>
                                    <button class="waves-effect waves-light btn modal-trigger btn-default" 
                                    onclick="modalEditMission(this)" href="#modal-edit-mission" id="{{ $mission->id }}">
                                        Editar
                                    </button>
                                    <form style="display:inline;" action="mission/delete/{{$mission->id}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir a habilidade {{$mission->name}}' )" class= "btn btn-danger btn-sm">
                                            <span  class="fa fa-trash-o">Deletar</span>
                                        </button>
                                    </form>  
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
                $("#id_edit").val(result.id);
                $("#name_edit").val(result.name);
                $("#name_edit").focus();

                // $("#modal-edit-mission").modal();

            },
            error: function (res) {
                console.log(res);
                console.log('erro');
            }
        });

        return false;
    }
</script>
@endsection