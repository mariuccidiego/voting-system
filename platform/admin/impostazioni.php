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
                <h1>Impostazioni</h1>
                <p>Qui va il contenuto della pagina.</p>

                <!-- Barra di Navigazione delle Impostazioni -->
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-generali-tab" data-toggle="pill" href="#pills-generali"
                            role="tab" aria-controls="pills-generali" aria-selected="true">Generali</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-votazione-tab" data-toggle="pill" href="#pills-votazione"
                            role="tab" aria-controls="pills-votazione" aria-selected="false">Votazione</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-voto-tab" data-toggle="pill" href="#pills-voto" role="tab"
                            aria-controls="pills-voto" aria-selected="false">Voto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-voto-tab" data-toggle="pill" href="#pills-voto" role="tab"
                            aria-controls="pills-voto" aria-selected="false">Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-voto-tab" data-toggle="pill" href="#pills-voto" role="tab"
                            aria-controls="pills-voto" aria-selected="false">Risultati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-voto-tab" data-toggle="pill" href="#pills-voto" role="tab"
                            aria-controls="pills-voto" aria-selected="false">Avanzate</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <!-- Sezione generali -->
                    <div class="tab-pane fade show active" id="pills-generali" role="tabpanel"
                        aria-labelledby="pills-generali-tab">
                        <h2>Generali</h2>

                        <form action="carica_modifiche.php" method="POST">
                            <div class="form-group">
                                <label for="title" class="form-label">Titolo <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    placeholder="Inserisci il titolo della votazione"
                                    value="<?php echo htmlspecialchars($votazione->titolo); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Descrizione</label>
                                <textarea class="form-control" id="description" name="description" rows="3"
                                    placeholder="Inserisci la descrizione della votazione"><?php echo htmlspecialchars($votazione->descrizione); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="start-date" class="form-label">Inizio Votazione</label>
                                <input type="datetime-local" class="form-control" id="start-date" name="start-date"
                                    value="<?php echo htmlspecialchars($votazione->inizio_votazione); ?>">
                            </div>
                            <div class="form-group">
                                <label for="end-date" class="form-label">Fine Votazione</label>
                                <input type="datetime-local" class="form-control" id="end-date" name="end-date"
                                    value="<?php echo htmlspecialchars($votazione->fine_votazione); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary">Salva modifiche</button>
                        </form>
                    </div>

                    <?php
                        $tipo_votazione = $votazione->tipo_votazione_id;

                        $voto_pesato_checked = $votazione->voto_pesato ? 'checked' : '';
                        $voto_segreto_checked = $votazione->voto_segreto ? 'checked' : '';
                        $voto_disgiunto_checked = $votazione->voto_disgiunto ? 'checked' : '';
                        $voto_per_sesso_checked = $votazione->voto_per_sesso ? 'checked' : '';
                        $voto_tramite_delega_checked = $votazione->voto_tramite_delega ? 'checked' : '';

                        $min_candidati = $votazione->min_candidati;
                        $max_candidati = $votazione->max_candidati;
                        $min_liste = $votazione->min_liste;
                        $max_liste = $votazione->max_liste;
                        $min_candidati_lista = $votazione->min_candidati_lista;
                        $max_candidati_lista = $votazione->max_candidati_lista;
                        $min_proposte = $votazione->min_proposte;
                        $max_proposte = $votazione->max_proposte;
                    ?>

                    <!-- Sezione Preferenze -->
                    <div class="tab-pane fade" id="pills-votazione" role="tabpanel"
                        aria-labelledby="pills-votazione-tab">
                        <h2>Votazione</h2>
                        <form method="post" action="carica_modifiche.php">
                            <div class="form-group">
                                <label for="tipo-votazione" class="form-label">Tipo di Votazione</label>
                                <div id="tipo-votazione" class="ml-3">
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="candidato" name="tipo_votazione"
                                            class="custom-control-input" value="1" <?php echo $tipo_votazione == 1 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="candidato">Candidato</label>
                                        <small class="form-text text-muted ml-4">Selezione di candidati per una
                                            posizione.</small>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="sondaggio" name="tipo_votazione"
                                            class="custom-control-input" value="2" <?php echo $tipo_votazione == 2 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="sondaggio">Sondaggio</label>
                                        <small class="form-text text-muted ml-4">Raccolta di opinioni su una questione
                                            specifica.</small>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="referendum" name="tipo_votazione"
                                            class="custom-control-input" value="3" <?php echo $tipo_votazione == 3 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="referendum">Referendum</label>
                                        <small class="form-text text-muted ml-4">Votazione su una proposta specifica o
                                            una legge.</small>
                                    </div>
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="testo_libero" name="tipo_votazione"
                                            class="custom-control-input" value="4" <?php echo $tipo_votazione == 4 ? 'checked' : ''; ?>>
                                        <label class="custom-control-label" for="testo_libero">Testo Libero</label>
                                        <small class="form-text text-muted ml-4">Votazione aperta dove gli elettori
                                            possono scrivere le loro risposte.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="voto-pesato" name="voto_pesato"
                                    <?php echo $voto_pesato_checked; ?>>
                                <label class="custom-control-label" for="voto-pesato">Voto Pesato</label>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="voto-segreto"
                                    name="voto_segreto" <?php echo $voto_segreto_checked; ?>>
                                <label class="custom-control-label" for="voto-segreto">Voto Segreto</label>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="voto-disgiunto"
                                    name="voto_disgiunto" <?php echo $voto_disgiunto_checked; ?>>
                                <label class="custom-control-label" for="voto-disgiunto">Voto Disgiunto</label>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="parita-genere"
                                    name="voto_per_sesso" <?php echo $voto_per_sesso_checked; ?>>
                                <label class="custom-control-label" for="parita-genere">Voto con Parità di
                                    Genere</label>
                            </div>
                            <div class="custom-control custom-switch mb-2">
                                <input type="checkbox" class="custom-control-input" id="delega-voto"
                                    name="voto_tramite_delega" <?php echo $voto_tramite_delega_checked; ?>>
                                <label class="custom-control-label" for="delega-voto">Delega del Voto</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Salva Cambiamenti</button>
                        </form>
                    </div>

                    <!-- Sezione Sicurezza -->
                    <div class="tab-pane fade" id="pills-voto" role="tabpanel" aria-labelledby="pills-voto-tab">
                        <h2>Configurazione Voto</h2>
                        <form method="post" action="carica_modifiche.php">

                            <!-- Risposta Testo Libero e Scheda Bianca -->
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="risposta-testo-libero" name="risposta-testo-libero">
                                <label class="form-check-label" for="risposta-testo-libero">Risposta a testo libero</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="scheda-bianca" name="scheda_bianca">
                                <label class="form-check-label" for="scheda-bianca">Scheda Bianca</label>
                            </div>

                            <?php if ($tipo_votazione == 1): // Candidato ?>
                                <div class="form-group">
                                    <label for="min-candidati" class="form-label">Numero minimo di candidati che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="min-candidati" name="min_candidati"
                                        value="<?php echo $min_candidati; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="max-candidati" class="form-label">Numero massimo di candidati che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="max-candidati" name="max_candidati"
                                        value="<?php echo $max_candidati; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="min-liste" class="form-label">Numero minimo di liste che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="min-liste" name="min_liste"
                                        value="<?php echo $min_liste; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="max-liste" class="form-label">Numero massimo di liste che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="max-liste" name="max_liste"
                                        value="<?php echo $max_liste; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="min-candidati-lista" class="form-label">Numero minimo di candidati di lista che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="min-candidati-lista"
                                        name="min_candidati_lista" value="<?php echo $min_candidati_lista; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="max-candidati-lista" class="form-label">Numero massimo di candidati di lista che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="max-candidati-lista"
                                        name="max_candidati_lista" value="<?php echo $max_candidati_lista; ?>">
                                </div>
                            <?php elseif ($tipo_votazione == 2): // Sondaggio ?>
                                <div class="form-group">
                                    <label for="min-proposte" class="form-label">Numero minimo di opzioni che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="min-proposte" name="min_proposte"
                                        value="<?php echo $min_proposte; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="max-proposte" class="form-label">Numero massimo di opzioni che può selezionare l'elettore</label>
                                    <input type="number" class="form-control" id="max-proposte" name="max_proposte"
                                        value="<?php echo $max_proposte; ?>">
                                </div>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary">Salva Cambiamenti</button>
                        </form>
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