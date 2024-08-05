<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['tipo_votazione'])) {
        $votazione->tipo_votazione_id = (int)$_POST['tipo_votazione'];
    }

    $votazione->voto_pesato = isset($_POST['voto_pesato']) ? 1 : 0;
    $votazione->voto_segreto = isset($_POST['voto_segreto']) ? 1 : 0;
    $votazione->voto_disgiunto = isset($_POST['voto_disgiunto']) ? 1 : 0;
    $votazione->voto_per_sesso = isset($_POST['voto_per_sesso']) ? 1 : 0;
    $votazione->voto_tramite_delega = isset($_POST['voto_tramite_delega']) ? 1 : 0;

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