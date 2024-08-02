<!-- Modal per aggiungere una nuova proposta -->
<div class="modal fade" id="aggPropostaModal" tabindex="-1" aria-labelledby="aggPropostaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggPropostaModalLabel">Aggiungi Proposta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-proposta-form" action="aggiungi_opzione.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="shortDescription" class="form-label">Descrizione Corta</label>
                            <textarea class="form-control" id="shortDescription" name="shortDescription"
                                maxlength="200"></textarea>
                            <small class="form-text text-muted">Massimo 200 caratteri.</small>
                        </div>
                        <div class="mb-3">
                            <label for="longDescription" class="form-label">Descrizione Lunga</label>
                            <textarea class="form-control" id="longDescription" name="longDescription"></textarea>
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-success">Aggiungi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>