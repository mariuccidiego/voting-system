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
                                                    data-id="<?php echo $votante->username; ?>"
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

    <?php include 'modals/elimina_elettore_modal.php'; ?>
    <?php include 'modals/modifica_elettore_modal.php'; ?>
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