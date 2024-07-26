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
                        <a class="nav-link" id="pills-preferences-tab" data-toggle="pill" href="#pills-preferences"
                            role="tab" aria-controls="pills-preferences" aria-selected="false">Votazione</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#pills-security" role="tab"
                            aria-controls="pills-security" aria-selected="false">Voto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#pills-security" role="tab"
                            aria-controls="pills-security" aria-selected="false">Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#pills-security" role="tab"
                            aria-controls="pills-security" aria-selected="false">Risultati</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-security-tab" data-toggle="pill" href="#pills-security" role="tab"
                            aria-controls="pills-security" aria-selected="false">Avanzate</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <!-- Sezione generali -->
                    <div class="tab-pane fade show active" id="pills-generali" role="tabpanel"
                        aria-labelledby="pills-generali-tab">
                        <h2>Impostazioni Account</h2>

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
                    <!-- Sezione Preferenze -->
                    <div class="tab-pane fade" id="pills-preferences" role="tabpanel"
                        aria-labelledby="pills-preferences-tab">
                        <h2>Impostazioni Votazione</h2>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Toggle this switch element</label>
                        </div>
                        <form>
                            <div class="form-group">
                                <label for="language">Lingua</label>
                                <select class="form-control" id="language">
                                    <option>Italiano</option>
                                    <option>Inglese</option>
                                    <option>Spagnolo</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="timezone">Fuso Orario</label>
                                <select class="form-control" id="timezone">
                                    <option>GMT</option>
                                    <option>GMT+1</option>
                                    <option>GMT+2</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Salva Cambiamenti</button>
                        </form>
                    </div>
                    <!-- Sezione Sicurezza -->
                    <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab">
                        <h2>Impostazioni Sicurezza</h2>
                        <form>
                            <div class="form-group">
                                <label for="current-password">Password Attuale</label>
                                <input type="password" class="form-control" id="current-password"
                                    placeholder="Inserisci password attuale">
                            </div>
                            <div class="form-group">
                                <label for="new-password">Nuova Password</label>
                                <input type="password" class="form-control" id="new-password"
                                    placeholder="Inserisci nuova password">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Conferma Nuova Password</label>
                                <input type="password" class="form-control" id="confirm-password"
                                    placeholder="Conferma nuova password">
                            </div>
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