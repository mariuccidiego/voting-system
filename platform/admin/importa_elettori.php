<?php
include 'includes/session.php';

function valida_riga_csv($data, $voto_pesato) {
    // Controlla che ci siano esattamente 3 colonne per votazione normale e 4 colonne per votazione pesata
    $colonne_attese = $voto_pesato ? 4 : 3;
    if (count($data) < 3 || count($data)>4) {
        return false;
    }
    
    // Controlla che l'email sia valida
    if (!filter_var($data[2], FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    
    // Se il voto è pesato, controlla che il Peso del Voto sia un numero intero positivo
    if ($voto_pesato && (!is_numeric($data[3]) || $data[3] <= 0)) {
        return false;
    }
    
    return true;
}

// Verifica che il metodo di richiesta sia POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica che il file sia stato caricato correttamente
    if (isset($_FILES['file_csv']) && $_FILES['file_csv']['error'] == 0) {
        $file_tmp = $_FILES['file_csv']['tmp_name'];

        // Ottieni le informazioni della votazione corrente
        $votazione = Votazione::createFromId($conn, $_SESSION['id_votazione']);

        // Apri il file CSV
        if (($handle = fopen($file_tmp, "r")) !== FALSE) {
            // Salta la prima riga se contiene intestazioni
            $header = fgetcsv($handle, 1000, ",");

            // Itera su ogni riga del CSV
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                // Valida la riga
                if (!valida_riga_csv($data, $votazione->voto_pesato)) {
                    $_SESSION['error'] = "Errore nella riga del CSV: " . implode(", ", $data) . ". Controlla i dati.";
                    fclose($handle);
                    header("location: elettori.php?id=" . $_SESSION['id_votazione']);
                    exit;
                }

                // Supponendo che l'ordine delle colonne sia: Nome, Cognome/Codice Fiscale, Email, Peso del Voto (se voto pesato)
                $nome = $data[0];
                $cognome = $data[1];
                $email = $data[2];

                // Gestione del peso del voto in base al tipo di votazione
                if($votazione->voto_pesato) {
                    $peso_voto = isset($data[3]) ? $data[3] : 1; // Default 1 se non specificato
                } else {
                    $peso_voto = 1; // Default 1 se non specificato
                }

                // Crea un nuovo oggetto Votante
                $votante = new Votante($conn);
                $votante->nome = $nome;
                $votante->cognome = $cognome;
                $votante->email = $email;
                $votante->peso_voto = $peso_voto;
                $votante->votazione_id = $_SESSION['id_votazione'];

                // Inserisci l'elettore nel database
                if (!$votante->create()) {
                    $_SESSION['error'] = "Errore durante l'importazione dell'elettore: $nome $cognome.";
                    fclose($handle);
                    header("location: elettori.php?id=" . $_SESSION['id_votazione']);
                    exit;
                }
            }
            // Chiudi il file CSV
            fclose($handle);

            // Redireziona con un messaggio di successo
            $_SESSION['success'] = 'Elettori importati con successo!';
            header("location: elettori.php?id=" . $_SESSION['id_votazione']);
            exit;
        } else {
            $_SESSION['error'] = "Errore durante l'apertura del file CSV.";
            header("location: elettori.php?id=" . $_SESSION['id_votazione']);
            exit;
        }
    } else {
        $_SESSION['error'] = "Errore nel caricamento del file.";
        header("location: elettori.php?id=" . $_SESSION['id_votazione']);
        exit;
    }
} else {
    header("location: elettori.php?id=" . $_SESSION['id_votazione']);
    exit;
}
?>
