<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $votazione->scheda_bianca = isset($_POST['scheda_bianca']) ? 1 : 0;
    $votazione->risposta_testo_libero = isset($_POST['risposta-testo-libero']) ? 1 : 0;

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

    if (!$votazione->scheda_bianca) {
        $query = "DELETE FROM proposta WHERE titolo='Scheda Bianca' AND votazione_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id_votazione']);
        $stmt->execute();
    }

    if ($votazione->scheda_bianca) {
        $query = "DELETE FROM proposta WHERE titolo='Scheda Bianca' AND votazione_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $_SESSION['id_votazione']);
        $stmt->execute();

        $query = "INSERT INTO proposta (titolo,votazione_id) VALUES ('Scheda Bianca',?)";
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