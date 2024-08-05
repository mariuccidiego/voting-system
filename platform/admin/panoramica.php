<?php include 'includes/session.php'; ?>
<?php include 'includes/get_vote_id.php'; ?>
<?php include 'includes/header.php'; ?>
<style>
    .alert-warning {
        border-color: #ffdc72;
    }
</style>

<body>
    <?php include 'includes/leftbar_votazione.php'; ?>

    <!-- Contenuto della Pagina -->
    <div class="right-site">
        <?php include 'includes/topbar.php'; ?>

        <!-- Contenuto Principale -->
        <div class="container mt-4">
        <h1>Panoramica</h1>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Finisci la configurazione della Votazione</strong>
                            <p>Per poter avviare la votazione devi prima concludere la configurazione della votazione.</p>
                            <a href="#" class="btn btn-warning">Configura Votazione</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Start Date</h5>
                                <p class="mb-0">Jul 11, 2024, 7:00:00 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">Start Date</h5>
                                <p class="mb-0">Jul 11, 2024, 7:00:00 PM</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="#" class="card h-100 text-white bg-success text-center text-decoration-none d-flex flex-column justify-content-center align-items-center">
                            <div class="card-body d-flex align-items-center">
                                <h5 class="card-title d-flex align-items-center mb-0">
                                    <i class="fas fa-play-circle fa-2x"></i>
                                    <span class="ml-2">Avvia Votazione</span>
                                </h5>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h5 class="card-title">URL della Votazione</h5>
                                <div class="mb-3">
                                    <label for="electionURL" class="form-label">URL Votazione</label>
                                    <input type="text" class="form-control" id="electionURL"
                                        value="https://quorumapp.com/votazione/323548" readonly>
                                    <small class="form-text text-muted ng-star-inserted"><i
                                            class="fa fa-info-circle"></i>  Questo URL non sarà accessibile fino all'avvio della votazione.</small>
                                </div>
                                <div class="mb-3">
                                    <label for="shortURL" class="form-label">URL Corto</label>
                                    <input type="text" class="form-control" id="shortURL" value="https://quorumapp.com/ew4dsa" readonly>
                                    <small class="form-text text-muted ng-star-inserted"><i
                                            class="fa fa-info-circle"></i>  Questo URL non sarà accessibile fino all'avvio della votazione</small>
                                </div>
                                <div class="mb-3">
                                    <label for="previewURL" class="form-label">URL Anteprima</label>
                                    <input type="text" class="form-control" id="previewURL"
                                        value="https://quorumapp.com/votazione/preview/323548" readonly>
                                </div>
                                <div>
                                    <a href="#">Click here to set up your organization's subdomain</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 h-100">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-cog"></i> Impostazioni</h5>
                                <p class="mb-0">Gestisci le impostazioni della tua votazione nella sezione <a href="#">Impostazioni</a>.</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-book"></i> Documentazione</h5>
                                <p class="mb-0">Consulta la nostra <a href="#">documentazione</a> per maggiori dettagli.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-headset"></i> Supporto</h5>
                                <p class="mb-0">Hai bisogno di aiuto? Contatta il <a href="#">supporto tecnico</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <?php include 'modals/toast_success.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>

</body>

</html>