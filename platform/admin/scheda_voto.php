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
                <h1>Scheda Voto</h1>
                <p>Qui va il contenuto della pagina.</p>

                <?php if ($votazione->tipo_votazione_id == 1): // Candidato ?>
                    <div class="mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#aggPropostaModal">
                            <i class="fas fa-user-plus"></i> Aggiungi Candidato
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-file-import"></i> Importa Candidati
                        </button>
                    </div>
                <?php elseif ($votazione->tipo_votazione_id == 2): // Sondaggio ?>
                    <div class="mb-3">
                        <button class="btn btn-success" data-toggle="modal" data-target="#aggPropostaModal">
                            <i class="fas fa-user-plus"></i> Aggiungi Opzione
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-file-import"></i> Importa Opzioni
                        </button>
                    </div>
                <?php endif; ?>

                <div class="candidati">

                    <?php if (!empty($votazione->proposte)): ?>
                        <?php foreach ($votazione->proposte as $proposta): ?>

                            <div class="card card-candidato">
                                <div class="card-body d-flex flex-column align-items-start">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="mb-0"><?php echo htmlspecialchars($proposta->titolo); ?></h4>
                                            </div>
                                        </div>
                                        <div class="navbar">
                                            <button class="btn btn-link" type="button" id="dropdownMenuButton1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="#"><i class="fas fa-edit"></i> Modifica</a>
                                                <a class="dropdown-item" href="#"><i class="fas fa-trash"></i> Elimina</a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($proposta->desc_corta!=null): ?>
                                    <p class="description mb-1">
                                    <?php echo htmlspecialchars($proposta->desc_corta); ?>
                                    </p>
                                    <?php endif; ?>

                                    <?php if ($proposta->descrizione!=null): ?>
                                    <a href="#" class="read-more">Leggi di più</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nessuna proposta</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?php include 'modals/aggiungi_proposta_modal.php'; ?>

    <?php include 'modals/toast_success.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>

</body>

</html>