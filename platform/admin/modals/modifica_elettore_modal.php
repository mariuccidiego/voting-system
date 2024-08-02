<div class="modal fade" id="editElettoreModal" tabindex="-1" aria-labelledby="editElettoreModalLabel"
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
                    <form action="modifica_elettore.php" method="POST">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="edit-nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome (oppure Codice Fiscale o Partita IVA)<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit-cognome" name="cognome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="edit-email" name="email" required>
                        </div>
                        <?php if ($votazione->voto_pesato): ?>
                            <div class="mb-3">
                                <label for="peso_voto" class="form-label">Peso del Voto</label>
                                <input type="number" class="form-control" id="peso_voto" name="peso_voto" min="1">
                            </div>
                        <?php endif; ?>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </form>
                </div>
            </div>
        </div>
    </div>