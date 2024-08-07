<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['avvia'])) {
        $ora_attuale = new DateTime("now", new DateTimeZone("UTC"));

        $end_time_utc = new DateTime($votazione->fine_votazione, new DateTimeZone("UTC"));

        if($ora_attuale >= $end_time_utc){
            $votazione->fine_votazione ="0000-00-00 00:00:00";
        }

        $votazione->inizio_votazione = $ora_attuale->format('Y-m-d H:i');
        if ($votazione->update()) {
            $_SESSION['success'] = 'Ora la votazione è aperta!';
            header("location: panoramica.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }

    } elseif (isset($_POST['ferma'])) {
        
        $ora_attuale = new DateTime("now", new DateTimeZone("UTC"));
        $votazione->fine_votazione = $ora_attuale->format('Y-m-d H:i');

        if ($votazione->update()) {
            $_SESSION['success'] = 'Ora la votazione è chiusa!';
            header("location: panoramica.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>