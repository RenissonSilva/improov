<div id="modal-create-mission" class="modal modal-fixed-footer modal-missions">
    <form action="{{ route('mission.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="row reset-margin">
                <span class="modal-title">Criar uma missão</span>
            </div>
            <div class="line"></div>
            <div class="center-align modal-github">
                <div class="row">
                    <div class="input-field col s12 mt-5">
                        <input id="name" type="text" name="name" required>
                        <label for="name">Nome *</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button class="waves-effect waves-green btn btn-mission">Salvar</button>
        </div>
    </form>
  </div>

  <div id="modal-edit-mission" class="modal modal-fixed-footer modal-missions">
    <form action="{{ route('mission.update') }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-content">
            <div class="row reset-margin">
                <span class="modal-title">Editar missão</span>
            </div>
            <div class="line"></div>
            <div class="center-align modal-github">
                <div class="row">
                    <div class="input-field col s12 mt-5">
                        <input type="hidden" name="id_edit" id="id_edit">
                        <input id="name_edit" type="text" name="name_edit" required>
                        <label for="name">Nome *</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">Cancelar</a>
            <button class="waves-effect waves-green btn btn-mission">Salvar</button>
        </div>
    </form>
  </div>