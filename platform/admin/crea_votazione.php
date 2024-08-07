<?php
	include 'includes/session.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(isset($_POST['title'])){
            $votazione = new Votazione($conn);
            $votazione->titolo = $_POST['title'];
    
            if(isset($_POST['description'])){
                $votazione->descrizione = $_POST['description'];
            }
    
            if(isset($_POST['start-date'])){
                $votazione->inizio_votazione = $_POST['start-date'];
            }
    
            if(isset($_POST['end-date'])){
                $votazione->fine_votazione = $_POST['end-date'];
            }

            if(isset($_POST['start-date']) && isset($_POST['end-date'])){

                $start_time_utc = new DateTime($_POST['start-date'], new DateTimeZone("UTC"));
                $end_time_utc = new DateTime($_POST['end-date'], new DateTimeZone("UTC"));

                if($start_time_utc >= $end_time_utc){
                    $votazione->fine_votazione ="0000-00-00 00:00:00";
                }
            }

            Amministratore::createFromUsername($conn, $username);
            $id_vot = Votazione::generaCodiceVotazione($conn);
            $votazione->id = $id_vot;
            $votazione->codice_votazione = $id_vot;
            $votazione->amministratore_username = $amministratore->username;
    
            if ($votazione->create()) {
                $_SESSION['success'] = 'Votazione creata con successo!';
                header("location: panoramica.php?id=".$id_vot);
    
            } else {
                echo "Errore durante la creazione della votazione.";
            }
        }
    }
?>