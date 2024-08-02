<?php
include 'includes/session.php';

$votazione_id=$_SESSION['id_votazione'];

$proposta = new Proposta($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['title'])) {
        $proposta->titolo = $_POST['title'];

        if (isset($_POST['shortDescription'])) {
            $proposta->desc_corta = $_POST['shortDescription'];
        }
    
        if (isset($_POST['longDescription'])) {
            $proposta->descrizione = $_POST['longDescription'];
        }
        $proposta->votazione_id= $votazione_id;

        if ($proposta->create()) {
            $_SESSION['success'] = 'Opzione aggiunta con successo!';
            header("location: scheda_voto.php?id=" . $_SESSION['id_votazione']);
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>