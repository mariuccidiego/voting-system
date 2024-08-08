<?php include 'includes/session.php'; ?>
<?php include 'includes/get_vote_id.php'; ?>
<?php include 'includes/header.php'; ?>

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
                        <strong>Configurazione della Votazione</strong>
                        <p>Controlla che la impostazioni della votazione siano corrette, quando crei una nuova votazione
                            alcune impostazioni vengono assegnate in automatico. Ricontrolla che sia tutto corretto per
                            iniziare la tua votazione.</p>
                        <a href="impostazioni.php?id= <?php echo $_SESSION['id_votazione'] ?>"
                            class="btn btn-warning">Configura Votazione</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Inizio Votazione</h5>
                            <p id="start-time" class="mb-0 start-time" data-utc="<?php
                            if ($votazione->inizio_votazione == "0000-00-00 00:00:00") {
                                echo "NaN";
                            } else {
                                echo htmlspecialchars($votazione->inizio_votazione);
                            }
                            ?>"></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Fine Votazione</h5>
                            <p id="end-time" class="mb-0 end-time" data-utc="<?php
                            if ($votazione->fine_votazione == " 0000-00-00 00:00:00") {
                                echo "NaN";
                            } else {
                                echo
                                    htmlspecialchars($votazione->fine_votazione);
                            }
                            ?>"></p>
                        </div>
                    </div>
                </div>

                <?php
                $start_time_from_db = $votazione->inizio_votazione;
                $end_time_from_db = $votazione->fine_votazione;

                if ($end_time_from_db == "0000-00-00 00:00:00") {
                    $end_time_from_db = "3000-00-00 00:00:00";
                }

                if ($start_time_from_db == "0000-00-00 00:00:00") {
                    ?>
                    <div class="col-md-4 mb-3">
                        <form action="inizio_fine_votazione.php" method="post"
                            class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
                            <button type="submit" name="avvia"
                                class="card h-100 w-100 text-white bg-success text-center text-decoration-none d-flex flex-column justify-content-center align-items-center border-0">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title d-flex align-items-center mb-0">
                                        <i class="fas fa-play-circle fa-2x"></i>
                                        <span class="ml-2">Avvia Votazione</span>
                                    </h5>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php
                }else{

                // Ottenere l'orario corrente in UTC
                $current_time_utc = new DateTime("now", new DateTimeZone("UTC"));

                // Convertire le date del database in oggetti DateTime
                $start_time_utc = new DateTime($start_time_from_db, new DateTimeZone("UTC"));
                $end_time_utc = new DateTime($end_time_from_db, new DateTimeZone("UTC"));

                // Controllare se l'orario corrente è tra l'inizio e la fine della votazione
                if ($current_time_utc >= $start_time_utc && $current_time_utc <= $end_time_utc) {
                    ?>
                    <div class="col-md-4 mb-3">
                        <form action="inizio_fine_votazione.php" method="post"
                            class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
                            <button type="submit" name="ferma"
                                class="card h-100 w-100 text-white bg-danger text-center text-decoration-none d-flex flex-column justify-content-center align-items-center border-0">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title d-flex align-items-center mb-0">
                                        <i class="fa fa-pause-circle fa-2x"></i>
                                        <span class="ml-2">Ferma Votazione</span>
                                    </h5>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="col-md-4 mb-3">
                        <form action="inizio_fine_votazione.php" method="post"
                            class="d-flex flex-column justify-content-center align-items-center h-100 w-100">
                            <button type="submit" name="avvia"
                                class="card h-100 w-100 text-white bg-success text-center text-decoration-none d-flex flex-column justify-content-center align-items-center border-0">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title d-flex align-items-center mb-0">
                                        <i class="fas fa-play-circle fa-2x"></i>
                                        <span class="ml-2">Avvia Votazione</span>
                                    </h5>
                                </div>
                            </button>
                        </form>
                    </div>
                    <?php
                }}
                ?>

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
                                <small class="form-text text-muted ng-star-inserted"><i class="fa fa-info-circle"></i>
                                    Questo URL non sarà accessibile fino all'avvio della votazione.</small>
                            </div>
                            <div class="mb-3">
                                <label for="shortURL" class="form-label">URL Corto</label>
                                <input type="text" class="form-control" id="shortURL"
                                    value="https://quorumapp.com/ew4dsa" readonly>
                                <small class="form-text text-muted ng-star-inserted"><i class="fa fa-info-circle"></i>
                                    Questo URL non sarà accessibile fino all'avvio della votazione</small>
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
                            <p class="mb-0">Gestisci le impostazioni della tua votazione nella sezione <a
                                    href="impostazioni.php?id= <?php echo $_SESSION['id_votazione'] ?>">Impostazioni</a>.
                            </p>
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