<?php
require_once 'config.php';

// Connessione al database usando
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Verifica la connessione
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>