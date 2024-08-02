<?php
include 'includes/session.php';

$votazione_id=$_SESSION['id_votazione'];

$proposta = new Proposta($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $proposta->readFromId($_POST['id']);

        if (isset($_POST['title'])) {
            $proposta->titolo = $_POST['title'];
    
            if (isset($_POST['shortDescription'])) {
                $proposta->desc_corta = $_POST['shortDescription'];
            }
        
            if (isset($_POST['longDescription'])) {
                $proposta->descrizione = $_POST['longDescription'];
            }
    
            if ($proposta->update()) {
                $_SESSION['success'] = 'Opzione aggiornata con successo!';
                header("location: scheda_voto.php?id=" . $_SESSION['id_votazione']);
            } else {
                echo "Errore durante il caricamento delle modifiche.";
            }
        }
    
    }
}
?>
