<?php include 'includes/session.php'; ?>
<?php include 'includes/get_vote_id.php'; ?>
<?php include 'includes/header.php'; ?>

<body>
    <?php include 'includes/leftbar_votazione.php'; ?>

    <!-- Contenuto della Pagina -->
    <div class="right-site">
        <?php include 'includes/topbar.php'; ?>

        <!-- Contenuto Principale -->
        <div class="content">
            <div class="container mt-4">
                <h1>Elettori</h1>
                <p>Qui va il contenuto della pagina.</p>
                <div class="mb-3">
                    <button class="btn btn-success" data-toggle="modal" data-target="#aggElettoreModal">
                        <i class="fas fa-user-plus"></i> Aggiungi Elettore
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-file-import"></i> Importa Elettore
                    </button>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Lista Utenti votanti
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple" class="display">
                            <thead>
                                <tr>
                                    <th>Nome Utente</th>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Email</th>
                                    <?php if ($votazione->voto_pesato): ?>
                                        <th>Peso Voto</th>
                                    <?php endif; ?>
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome Utente</th>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Email</th>
                                    <?php if ($votazione->voto_pesato): ?>
                                        <th>Peso Voto</th>
                                    <?php endif; ?>
                                    <th>Azioni</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php if (!empty($votazione->votanti)): ?>
                                    <?php foreach ($votazione->votanti as $votante): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($votante->username); ?></td>
                                            <td><?php echo htmlspecialchars($votante->nome); ?></td>
                                            <td><?php echo htmlspecialchars($votante->cognome); ?></td>
                                            <td><?php echo htmlspecialchars($votante->email); ?></td>
                                            <?php if ($votazione->voto_pesato): ?>
                                                <td><?php echo htmlspecialchars($votante->peso_voto); ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <button class="btn btn-primary btn-sm edit-button"
                                                    data-id="<?php echo $votante->id; ?>"
                                                    data-nome="<?php echo htmlspecialchars($votante->nome); ?>"
                                                    data-cognome="<?php echo htmlspecialchars($votante->cognome); ?>"
                                                    data-email="<?php echo htmlspecialchars($votante->email); ?>"
                                                    <?php if ($votazione->voto_pesato): ?>
                                                        data-peso="<?php echo htmlspecialchars($votante->peso_voto); ?>"
                                                    <?php endif; ?>
                                                    data-toggle="modal" data-target="#editElettoreModal">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm delete-button"
                                                    data-id="<?php echo $votante->id; ?>" data-toggle="modal"
                                                    data-target="#deleteConfirmModal">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <?php include 'modals/aggiungi_elettore_modal.php'; ?>
    <?php include 'modals/toast_success.php'; ?>
    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>
    <script>
        $(document).ready(function () {
            $('#datatablesSimple').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/it-IT.json"
                }
            });

            // Delete button click event
            $('.delete-button').on('click', function () {
                var id = $(this).data('id');
                $('#delete-id').val(id);
            });

            $('.edit-button').on('click', function () {
                var id = $(this).data('id');
                var nome = $(this).data('nome');
                var cognome = $(this).data('cognome');
                var email = $(this).data('email');
                var peso = $(this).data('peso');

                // Set the values in the edit modal form
                $('#edit-id').val(id);
                $('#edit-nome').val(nome);
                $('#edit-cognome').val(cognome);
                $('#edit-email').val(email);

                // Check if the voting is weighted and show/hide the "Peso del Voto" field accordingly
                if (peso !== undefined) {
                    $('#peso_voto').val(peso);
                } else {
                    $('#peso_voto').val('');
                }
            });
        });
    </script>
</body>

</html>