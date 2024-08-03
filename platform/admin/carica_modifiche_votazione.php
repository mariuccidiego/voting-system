<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['title'])) {
        $votazione->titolo = $_POST['title'];
    }
    
    if (isset($_POST['description'])) {
        $votazione->descrizione = $_POST['description'];
    }

    if (isset($_POST['start-date'])) {
        $votazione->inizio_votazione = $_POST['start-date'];
    }

    if (isset($_POST['end-date'])) {
        $votazione->fine_votazione = $_POST['end-date'];
    }

    if (isset($_POST['tipo_votazione'])) {
        $votazione->tipo_votazione_id = (int)$_POST['tipo_votazione'];
    }

    $votazione->voto_pesato = isset($_POST['voto_pesato']) ? 1 : 0;
    $votazione->voto_segreto = isset($_POST['voto_segreto']) ? 1 : 0;
    $votazione->voto_disgiunto = isset($_POST['voto_disgiunto']) ? 1 : 0;
    $votazione->voto_per_sesso = isset($_POST['voto_per_sesso']) ? 1 : 0;
    $votazione->voto_tramite_delega = isset($_POST['voto_tramite_delega']) ? 1 : 0;

    // Update voting options
    if ($votazione->tipo_votazione_id == 1) {
        // Candidato
        $votazione->min_candidati = $_POST['min_candidati'] ?? null;
        $votazione->max_candidati = $_POST['max_candidati'] ?? null;
        $votazione->min_liste = $_POST['min_liste'] ?? null;
        $votazione->max_liste = $_POST['max_liste'] ?? null;
        $votazione->min_candidati_lista = $_POST['min_candidati_lista'] ?? null;
        $votazione->max_candidati_lista = $_POST['max_candidati_lista'] ?? null;
    } elseif ($votazione->tipo_votazione_id == 2) {
        // Sondaggio
        $votazione->min_proposte = $_POST['min_proposte'] ?? null;
        $votazione->max_proposte = $_POST['max_proposte'] ?? null;
    }

    if (!$votazione->voto_pesato) {
        $query = "UPDATE votante SET peso_voto = 1 WHERE votazione_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id_votazione']);
        $stmt->execute();
    }

    if ($votazione->update()) {
        $_SESSION['success'] = 'Votazione aggiornata con successo!';
        header("location: impostazioni.php?id=" . $_SESSION['id_votazione']);
    } else {
        echo "Errore durante il caricamento delle modifiche.";
    }
}
?>