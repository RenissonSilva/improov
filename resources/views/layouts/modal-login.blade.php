<div id="modal-login" class="modal modal-login">
  <div class="modal-content">
    <div class="row reset-margin">
      <span class="modal-title">Entrar com github</span>
      <i class="fas fa-info-circle right tooltipped" data-position="bottom" data-tooltip="É necessário ter conta no github para usar o Improov"></i>
    </div>
    <div class="line"></div>
    <div class="center-align modal-github">
      <i class="fab fa-github"></i>
    </div>

    <div class="row center-align">
      <a class="waves-effect waves-light btn-large btn-without-account btn-default" href="https://github.com/join?source=login" target="_blank"><i class="material-icons left">close</i>Não tenho conta</a>
      <a class="waves-effect waves-light btn-large btn-account btn-default" href="{{ url('login/github') }}"><i class="material-icons left">done</i>Já tenho conta</a>
    </div>
  </div>
</div>