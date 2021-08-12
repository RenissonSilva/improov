<div id="modal-create-mission" class="modal modal-fixed-footer modal-missions">
    <form id="criar-missao" method="POST">
        @csrf
        <div class="modal-content modal-padding">
            <div class="row reset-margin">
                <span class="modal-title">Criar missão</span>
            </div>
            <div class="line"></div>
            <div class="center-align modal-github">
                <div class="row">
                    <div class="input-field col s12 mt-5">
                        <input id="name" type="text" name="name" required>
                        <label for="name">Nome *</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <select name="repeat_mission" class="repeat_mission">
                            <option value="0" selected>Desabilitado</option>
                            <option value="1">Repetir Diariamente</option>
                            <!-- <option value="2">Repetir Semanalmente</option> -->
                        </select>
                        <label>Repetir * <i class="fas fa-info-circle right tooltipped" data-position="bottom" data-tooltip="Para agendar a repetição você precisa primeiramente ativar a missão" style="font-size:18px;"></i></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat black_simple_link grey-text text-darken-2">Cancelar</a>
            <button class="waves-effect waves-green btn btn-mission" id="criar-missao-btn-salvar">SALVAR</button>
        </div>
    </form>
  </div>

  <div id="modal-edit-mission" class="modal modal-fixed-footer modal-missions">
    <form action="{{ route('mission.update') }}" id="editar-missao" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-content modal-padding">
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

                <div class="row">
                    <div class="input-field col s12">
                        <select name="repeat_mission" class="repeat_mission" id="repeat_mission_edit">
                            <option value="0" selected>Desabilitado</option>
                            <option value="1">Repetir Diariamente</option>
                            <!-- <option value="2">Repetir Semanalmente</option> -->
                        </select>
                        <label>Repetir * <i class="fas fa-info-circle right tooltipped" data-position="bottom" data-tooltip="Para agendar a repetição você precisa primeiramente ativar a missão" style="font-size:18px;"></i></label>

                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="id-edit" name="id_edit">
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat black_simple_link grey-text text-darken-2">Cancelar</a>
            <button class="waves-effect waves-green btn btn-mission">SALVAR</button>
        </div>
    </form>
  </div>

  <div id="modal-delete-mission" class="modal modal-delete modal-confirm">
    <div class="modal-content modal-padding modal-content-confirm">
      <h4>Confirmação</h4>
      <p class="confirm-text grey-text text-darken-2">Tem certeza que deseja excluir essa missão?</p>
      <div class="right-align">
          <a class="modal-close waves-effect waves-green btn-flat black_simple_link grey-text text-darken-2">Cancelar</a>
          <form id="form-delete" style="display:inline;" method="post">
              @csrf
              @method('DELETE')
              <input type="hidden" id="id_delete" name="id_delete">
              <button type="submit" class="btn red modal-trigger btn-remove"  id="btn-del">Excluir</button>
          </form>
      </div>
    </div>
  </div>
