<?php
include 'includes/session.php';

// Assuming $conn is your database connection
$votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['duplica'])) {


    } elseif (isset($_POST['elimina'])) {
        $query = "DELETE FROM votazione WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $_SESSION['id_votazione']);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = 'Votazione eliminata con successo!';
            header("location: votazioni.php");
        } else {
            echo "Errore durante il caricamento delle modifiche.";
        }
    }
}
?>