<?php
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($votante->votato) {
        header('location: gia_votato.php');
    }else{
        if ($votazione->tipo_votazione_id == 1) {

        } else if ($votazione->tipo_votazione_id == 2) {
            if (!empty($_POST['voti'])) {
                $voti = $_POST['voti'];
    
                foreach ($voti as $voto) {
    
                    $data_ora = date('Y-m-d H:i:s');
    
                    $query = "INSERT INTO voto_proposta (data_ora, votante_id, votazione_id, proposta_id) VALUES (?, ?, ?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('siii', $data_ora, $votante->id, $votazione->id, $voto);
                    $stmt->execute();
    
                    echo "Hai votato per la proposta con ID: " . htmlspecialchars($voto) . "<br>";
                }
                $query = "UPDATE votante SET votato=1 WHERE id=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('i', $votante->id);
                $stmt->execute();

                session_destroy();

	            header('location: grazie.php');
            } else {
                echo "Nessuna proposta selezionata.";
            }
        }
    }
} else {
    echo "Metodo di richiesta non valido.";
}
?>