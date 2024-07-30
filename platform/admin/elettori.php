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
                    <button class="btn btn-success" data-toggle="modal" data-target="#addCandidateModal">
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
                                    <th>Azioni</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nome Utente</th>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Email</th>
                                    <th>Azioni</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>d-mariucci-800</td>
                                    <td>Diego</td>
                                    <td>Mariucci</td>
                                    <td>mariuccidiego@gmail.com</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm delete-button">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Altri elettori -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>
    <script>
        $(document).ready(function() {
            $('#datatablesSimple').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/2.1.2/i18n/it-IT.json"
                }
            });
        });
    </script>
</body>
</html>