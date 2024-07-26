<!-- Modal for Creating Election -->
<div class="modal fade" id="createElectionModal" tabindex="-1" aria-labelledby="createElectionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createElectionModalLabel">Crea una nuova Votazione</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-election-form" action="crea_votazione.php" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start-date" class="form-label">Inizio Votazione</label>
                            <input type="datetime-local" class="form-control" id="start-date" name="start-date">
                        </div>
                        <div class="mb-3">
                            <label for="end-date" class="form-label">Fine Votazione</label>
                            <input type="datetime-local" class="form-control" id="end-date" name="end-date">
                        </div>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-success">Crea Votazione</button>
                    </form>
                </div>
            </div>
        </div>
    </div>