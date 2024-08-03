<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

$proposta = new Proposta($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        echo $_POST['id'];
        if ($proposta->deleteFromId($_POST['id'])) {
            $_SESSION['success'] = 'Opzione eliminata con successo!';
            header("location: scheda_voto.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>