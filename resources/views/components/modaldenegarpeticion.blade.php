<div class="modal" id="denegar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Estas seguro?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Si deniegas la peticion no se podra cambiar luego.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="location.href='{{route('denySpecificRequest', ['id' => $peticionespecifica->id])}}'">Denegar</button>
          </div>
        </div>
    </div>
  </div>