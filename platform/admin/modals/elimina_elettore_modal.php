<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Conferma Eliminazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare questo elettore?
                </div>
                <div class="modal-footer">
                    <form action="elimina_elettore.php" method="POST">
                        <input type="hidden" id="delete-id" name="id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-danger">Elimina</button>
                    </form>
                </div>
            </div>
        </div>
    </div>