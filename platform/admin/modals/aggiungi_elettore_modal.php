    <!-- Modal per aggiungere un nuovo elettore -->
    <div class="modal fade" id="aggElettoreModal" tabindex="-1" aria-labelledby="aggElettoreModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggElettoreModalLabel">Aggiungi Elettore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-voter-form" action="aggiungi_elettore.php" method="POST">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome (oppure Codice Fiscale o Partita IVA)<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="cognome" name="cognome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <?php if ($votazione->voto_pesato): ?>
                            <div class="mb-3">
                                <label for="peso_voto" class="form-label">Peso del Voto</label>
                                <input type="number" class="form-control" id="peso_voto" name="peso_voto" value="1" min="1">
                            </div>
                        <?php endif; ?>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-success">Aggiungi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>