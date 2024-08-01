<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

$votante = new Votante($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        if ($votante->deleteFromId($_POST['id'])) {
            $_SESSION['success'] = 'Elettore eliminato con successo!';
            header("location: elettori.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>