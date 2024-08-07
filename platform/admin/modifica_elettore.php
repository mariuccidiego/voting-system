<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

$votante = new Votante($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id'])) {

        $votante->readFromUser($_POST['id']);

        if (isset($_POST['nome'])) {
            $votante->nome = $_POST['nome'];
        }
        
        if (isset($_POST['cognome'])) {
            $votante->cognome = $_POST['cognome'];
        }
    
        if (isset($_POST['email'])) {
            $votante->email = $_POST['email'];
        }
    
        if (isset($_POST['peso_voto'])) {
            $votante->peso_voto = $_POST['peso_voto'];
        }
    
        if ($votante->update()) {
            $_SESSION['success'] = 'Elettore aggiornato con successo!';
            header("location: elettori.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>