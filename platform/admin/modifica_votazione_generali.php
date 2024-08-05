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

    if ($votazione->update()) {
        $_SESSION['success'] = 'Votazione aggiornata con successo!';
        header("location: impostazioni.php?id=" . $_SESSION['id_votazione']);
    } else {
        echo "Errore durante il caricamento delle modifiche.";
    }
}
?>