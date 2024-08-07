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
                <div class="row">
                    <div class="col-md-3">
                        <!-- Barra di Navigazione delle Impostazioni -->
                        <div class="list-group" id="pills-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="pills-generali-tab"
                                data-toggle="pill" href="#pills-generali" role="tab" aria-controls="pills-generali"
                                aria-selected="true">Generali</a>
                            <a class="list-group-item list-group-item-action" id="pills-votazione-tab"
                                data-toggle="pill" href="#pills-votazione" role="tab" aria-controls="pills-votazione"
                                aria-selected="false">Votazione</a>
                            <a class="list-group-item list-group-item-action" id="pills-voto-tab" data-toggle="pill"
                                href="#pills-voto" role="tab" aria-controls="pills-voto"
                                aria-selected="false">Configurazione Voto</a>
                            <a class="list-group-item list-group-item-action" id="pills-email-tab" data-toggle="pill"
                                href="#pills-email" role="tab" aria-controls="pills-email"
                                aria-selected="false">Email</a>
                            <a class="list-group-item list-group-item-action" id="pills-risultati-tab"
                                data-toggle="pill" href="#pills-risultati" role="tab" aria-controls="pills-risultati"
                                aria-selected="false">Risultati</a>
                            <a class="list-group-item list-group-item-action" id="pills-avanzate-tab" data-toggle="pill"
                                href="#pills-avanzate" role="tab" aria-controls="pills-avanzate"
                                aria-selected="false">Avanzate</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content" id="pills-tabContent">
                            <!-- Sezione generali -->
                            <div class="tab-pane fade show active" id="pills-generali" role="tabpanel"
                                aria-labelledby="pills-generali-tab">
                                <h2>Generali</h2>

                                <form action="modifica_votazione_generali.php" method="POST" id="create-election-form">
                                    <div class="form-group">
                                        <label for="title" class="form-label">Titolo <span
                                                class="text-danger">*</span></label>
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
                                        <input type="datetime-local" class="form-control start-date" id="start-date"
                                            name="start-date" data-utc="<?php
                                            if ($votazione->inizio_votazione == "0000-00-00 00:00:00") {
                                                echo "NaN";
                                            } else {
                                                echo htmlspecialchars($votazione->inizio_votazione);
                                            }
                                            ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="end-date" class="form-label">Fine Votazione</label>
                                        <input type="datetime-local" class="form-control end-date" id="end-date"
                                            name="end-date" data-utc="<?php
                                            if ($votazione->fine_votazione == "0000-00-00 00:00:00") {
                                                echo "NaN";
                                            } else {
                                                echo htmlspecialchars($votazione->fine_votazione);
                                            }
                                            ?>">
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
                            $scheda_bianca = $votazione->scheda_bianca ? 'checked' : '';
                            $risposta_testo_libero = $votazione->risposta_testo_libero ? 'checked' : '';

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
                                <form method="post" action="modifica_votazione.php">
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
                                                <small class="form-text text-muted ml-4">Raccolta di opinioni su una
                                                    questione
                                                    specifica.</small>
                                            </div>
                                            <div class="custom-control custom-radio mb-2">
                                                <input type="radio" id="referendum" name="tipo_votazione"
                                                    class="custom-control-input" value="3" <?php echo $tipo_votazione == 3 ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="referendum">Referendum</label>
                                                <small class="form-text text-muted ml-4">Votazione su una proposta
                                                    specifica
                                                    o
                                                    una legge.</small>
                                            </div>
                                            <div class="custom-control custom-radio mb-2">
                                                <input type="radio" id="testo_libero" name="tipo_votazione"
                                                    class="custom-control-input" value="4" <?php echo $tipo_votazione == 4 ? 'checked' : ''; ?>>
                                                <label class="custom-control-label" for="testo_libero">Testo
                                                    Libero</label>
                                                <small class="form-text text-muted ml-4">Votazione aperta dove gli
                                                    elettori
                                                    possono scrivere le loro risposte.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-switch mb-2">
                                        <input type="checkbox" class="custom-control-input" id="voto-pesato"
                                            name="voto_pesato" <?php echo $voto_pesato_checked; ?>>
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
                                <form method="post" action="modifica_votazione_voto.php">

                                    <!-- Risposta Testo Libero e Scheda Bianca -->
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="risposta-testo-libero"
                                            name="risposta-testo-libero" <?php echo $risposta_testo_libero; ?>>
                                        <label class="form-check-label" for="risposta-testo-libero">Risposta a testo
                                            libero</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="scheda-bianca"
                                            name="scheda_bianca" <?php echo $scheda_bianca; ?>>
                                        <label class="form-check-label" for="scheda-bianca">Scheda Bianca</label>
                                    </div>

                                    <?php if ($tipo_votazione == 1): // Candidato ?>
                                        <div class="form-group">
                                            <label for="min-candidati" class="form-label">Numero minimo di candidati che può
                                                selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="min-candidati"
                                                name="min_candidati" value="<?php echo $min_candidati; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="max-candidati" class="form-label">Numero massimo di candidati che
                                                può
                                                selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="max-candidati"
                                                name="max_candidati" value="<?php echo $max_candidati; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="min-liste" class="form-label">Numero minimo di liste che può
                                                selezionare
                                                l'elettore</label>
                                            <input type="number" class="form-control" id="min-liste" name="min_liste"
                                                value="<?php echo $min_liste; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="max-liste" class="form-label">Numero massimo di liste che può
                                                selezionare
                                                l'elettore</label>
                                            <input type="number" class="form-control" id="max-liste" name="max_liste"
                                                value="<?php echo $max_liste; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="min-candidati-lista" class="form-label">Numero minimo di candidati
                                                di
                                                lista
                                                che può selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="min-candidati-lista"
                                                name="min_candidati_lista" value="<?php echo $min_candidati_lista; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="max-candidati-lista" class="form-label">Numero massimo di candidati
                                                di
                                                lista
                                                che può selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="max-candidati-lista"
                                                name="max_candidati_lista" value="<?php echo $max_candidati_lista; ?>">
                                        </div>
                                    <?php elseif ($tipo_votazione == 2): // Sondaggio ?>
                                        <div class="form-group">
                                            <label for="min-proposte" class="form-label">Numero minimo di opzioni che può
                                                selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="min-proposte" name="min_proposte"
                                                value="<?php echo $min_proposte; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="max-proposte" class="form-label">Numero massimo di opzioni che può
                                                selezionare l'elettore</label>
                                            <input type="number" class="form-control" id="max-proposte" name="max_proposte"
                                                value="<?php echo $max_proposte; ?>">
                                        </div>
                                    <?php endif; ?>

                                    <button type="submit" class="btn btn-primary">Salva Cambiamenti</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="pills-avanzate" role="tabpanel"
                                aria-labelledby="pills-avanzate-tab">
                                <h2>Avanzate</h2>
                                <form method="post" action="imp_avanzate.php">
                                    <div class="card mb-4">
                                        <div class="card-header bg-secondary text-white">
                                            Duplica Votazione
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Utilizza questa opzione per creare una copia esatta
                                                della votazione corrente. Tutte le impostazioni e le opzioni saranno
                                                duplicate, permettendoti di risparmiare tempo nella configurazione di
                                                una nuova votazione simile.</p>
                                            <button type="submit" name="duplica" class="btn btn-secondary">Duplica
                                                Votazione</button>
                                        </div>
                                    </div>

                                    <!-- Elimina Votazione -->
                                    <div class="card mb-4">
                                        <div class="card-header bg-danger text-white">
                                            Elimina Votazione
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">ATTENZIONE: Utilizza questa opzione per eliminare
                                                definitivamente la votazione corrente. Questa azione è irreversibile e
                                                tutti i dati associati a questa votazione saranno persi.</p>
                                            <button type="submit" name="elimina" class="btn btn-danger"
                                                onclick="return confirm('Sei sicuro di voler eliminare questa votazione? Questa azione è irreversibile.');">Elimina
                                                Votazione</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'modals/toast_success.php'; ?>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/page_active.php'; ?>

    <script>
        function convertDate(inputDate) {
            let s = inputDate + "";
            // Dividi la stringa della data e dell'ora
            let [date, time] = s.split(', ');

            // Dividi la data in giorno, mese e anno
            let [day, month, year] = date.split('/');

            // Combina i componenti in formato ISO 8601
            let isoDate = `${year}-${month}-${day}T${time}.000`;

            return isoDate;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Ottieni il fuso orario dell'utente
            const userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
            console.log(userTimezone);

            // Funzione per convertire UTC a fuso orario dell'utente
            function convertUTCToUserTime(utcDateStr, timezone) {
                const utcDate = new Date(utcDateStr);
                let pippo = new Date(utcDate.toLocaleString('it-IT', { timeZone: timezone }));
                console.log(utcDate.toLocaleString('it-IT', { timeZone: timezone }));
                return convertDate(utcDate.toLocaleString('it-IT', { timeZone: timezone }) + "");
            }

            // Funzione per aggiornare il testo degli elementi con una classe specifica
            function updateTimeElementsByClass(className) {
                const elements = document.querySelectorAll(`.${className}`);
                elements.forEach(element => {
                    const utcDateStr = element.getAttribute('data-utc');
                    if (utcDateStr === "NaN" || !utcDateStr) {
                        element.textContent = "Non Stabilita";
                    } else {
                        const utcDate = utcDateStr + "Z";
                        console.log(convertUTCToUserTime(utcDate, userTimezone));
                        element.value = convertUTCToUserTime(utcDate, userTimezone);
                    }
                });
            }

            // Aggiorna gli elementi con le classi start-time ed end-time
            updateTimeElementsByClass('start-date');
            updateTimeElementsByClass('end-date');
        });


        document.getElementById('create-election-form').addEventListener('submit', function (event) {
            event.preventDefault();

            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');

            // Convert the local date-time to UTC date-time
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            // Format the dates to ISO 8601 with Z (UTC)
            if (startDateInput.value) {
                const startDateUTC = startDate.toISOString();
                startDateInput.value = startDateUTC.substring(0, 19);
            }

            if (endDateInput.value) {
                const endDateUTC = endDate.toISOString();
                endDateInput.value = endDateUTC.substring(0, 19);
            }

            event.target.submit();
        });
    </script>
</body>

</html>