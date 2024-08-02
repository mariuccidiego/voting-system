<div class="modal fade" id="modificaOpzioneModal" tabindex="-1" aria-labelledby="modificaOpzioneModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editElettoreModalLabel">Modifica Elettore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modificaForm" method="POST" action="modifica_opzione.php">
                        <input type="hidden" name="id" id="modificaOpzioneId">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title-modifica" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="shortDescription" class="form-label">Descrizione Corta</label>
                            <textarea class="form-control" id="shortDescription-modifica" name="shortDescription"
                                maxlength="200"></textarea>
                            <small class="form-text text-muted">Massimo 200 caratteri.</small>
                        </div>
                        <div class="mb-3">
                            <label for="longDescription" class="form-label">Descrizione Lunga</label>
                            <textarea class="form-control" id="longDescription-modifica" name="longDescription"></textarea>
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>