<?php
class Votazione {
    private $conn;
    private $table_name = "votazione";

    public $id = null;
    public $codice_votazione = null;
    public $titolo;
    public $descrizione = null;
    public $immagine = null;
    public $inizio_votazione = null;
    public $fine_votazione = null;
    public $voto_segreto = 1; // Default to TRUE
    public $voto_disgiunto = 0; // Default to FALSE
    public $voto_pesato = 0; // Default to FALSE
    public $voto_tramite_delega = 0; // Default to FALSE
    public $scheda_bianca = 0; // Default to FALSE
    public $voto_per_sesso = 0; // Default to FALSE
    public $risposta_testo_libero = 0; // Default to FALSE
    public $voto_a_sezione = 0; // Default to FALSE
    public $archiviata = 0; // Default to FALSE
    public $min_candidati = 1; // Default to 1
    public $min_liste = 1; // Default to 1
    public $min_candidati_lista = 1; // Default to 1
    public $min_proposte = 1; // Default to 1
    public $max_candidati = 1; // Default to 1
    public $max_liste = 1; // Default to 1
    public $max_candidati_lista = 1; // Default to 1
    public $max_proposte = 1; // Default to 1
    public $link = null;
    public $tipo_votazione_id = 2;
    public $amministratore_username = null;

    public function __construct($db) {
        $this->conn = $db;
    }

    public static function generaCodiceVotazione($conn) {
    do {
        // Genera un numero casuale a 6 cifre
        $codice = sprintf('%06d', rand(0, 999999));
        
        // Query per controllare l'unicità del codice
        $query = "SELECT COUNT(*) as count FROM votazione WHERE codice_votazione = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $codice);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        // Verifica se il codice esiste già
        $exists = $row['count'] > 0;
    } while ($exists);  // Continua fino a trovare un codice unico

    return $codice;
}


    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
        (id, codice_votazione, titolo, descrizione, immagine, inizio_votazione, fine_votazione, voto_segreto, 
        voto_disgiunto, voto_pesato, voto_tramite_delega, scheda_bianca, voto_per_sesso, risposta_testo_libero, 
        voto_a_sezione, archiviata, min_candidati, min_liste, min_candidati_lista, min_proposte, max_candidati, 
        max_liste, max_candidati_lista, max_proposte, link, tipo_votazione_id, amministratore_username) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $this->sanitize();

        // Assicurati che la stringa di tipo di bind_param corrisponda esattamente al numero di variabili
        $stmt->bind_param('issssssiiiiiiiiiiiiiiiiisss',
            $this->id,
            $this->codice_votazione,
            $this->titolo,
            $this->descrizione,
            $this->immagine,
            $this->inizio_votazione,
            $this->fine_votazione,
            $this->voto_segreto,
            $this->voto_disgiunto,
            $this->voto_pesato,
            $this->voto_tramite_delega,
            $this->scheda_bianca,
            $this->voto_per_sesso,
            $this->risposta_testo_libero,
            $this->voto_a_sezione,
            $this->archiviata,
            $this->min_candidati,
            $this->min_liste,
            $this->min_candidati_lista,
            $this->min_proposte,
            $this->max_candidati,
            $this->max_liste,
            $this->max_candidati_lista,
            $this->max_proposte,
            $this->link,
            $this->tipo_votazione_id,
            $this->amministratore_username
        );

        return $stmt->execute();
    }

    public static function createFromId($db, $id) {
        $instance = new self($db);
        $instance->id = $id;
        $instance->readOne();
        return $instance;
    }

    public static function exists($db, $id) {
        $query = "SELECT COUNT(*) as count FROM votazione WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        return $row['count'] > 0;
    }
    

    public function sanitize() {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->codice_votazione = htmlspecialchars(strip_tags($this->codice_votazione));
        $this->titolo = htmlspecialchars(strip_tags($this->titolo));
        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));
        $this->immagine = htmlspecialchars(strip_tags($this->immagine));
        $this->inizio_votazione = htmlspecialchars(strip_tags($this->inizio_votazione));
        $this->fine_votazione = htmlspecialchars(strip_tags($this->fine_votazione));
        $this->voto_segreto = htmlspecialchars(strip_tags($this->voto_segreto));
        $this->voto_disgiunto = htmlspecialchars(strip_tags($this->voto_disgiunto));
        $this->voto_pesato = htmlspecialchars(strip_tags($this->voto_pesato));
        $this->voto_tramite_delega = htmlspecialchars(strip_tags($this->voto_tramite_delega));
        $this->scheda_bianca = htmlspecialchars(strip_tags($this->scheda_bianca));
        $this->voto_per_sesso = htmlspecialchars(strip_tags($this->voto_per_sesso));
        $this->risposta_testo_libero = htmlspecialchars(strip_tags($this->risposta_testo_libero));
        $this->voto_a_sezione = htmlspecialchars(strip_tags($this->voto_a_sezione));
        $this->archiviata = htmlspecialchars(strip_tags($this->archiviata));
        $this->min_candidati = htmlspecialchars(strip_tags($this->min_candidati));
        $this->min_liste = htmlspecialchars(strip_tags($this->min_liste));
        $this->min_candidati_lista = htmlspecialchars(strip_tags($this->min_candidati_lista));
        $this->min_proposte = htmlspecialchars(strip_tags($this->min_proposte));
        $this->max_candidati = htmlspecialchars(strip_tags($this->max_candidati));
        $this->max_liste = htmlspecialchars(strip_tags($this->max_liste));
        $this->max_candidati_lista = htmlspecialchars(strip_tags($this->max_candidati_lista));
        $this->max_proposte = htmlspecialchars(strip_tags($this->max_proposte));
        $this->link = htmlspecialchars(strip_tags($this->link));
        $this->tipo_votazione_id = htmlspecialchars(strip_tags($this->tipo_votazione_id));
        $this->amministratore_username = htmlspecialchars(strip_tags($this->amministratore_username));
    }

    public function assignProperties($row) {
        $this->id = $row['id'];
        $this->codice_votazione = $row['codice_votazione'];
        $this->titolo = $row['titolo'];
        $this->descrizione = $row['descrizione'];
        $this->immagine = $row['immagine'];
        $this->inizio_votazione = $row['inizio_votazione'];
        $this->fine_votazione = $row['fine_votazione'];
        $this->voto_segreto = $row['voto_segreto'];
        $this->voto_disgiunto = $row['voto_disgiunto'];
        $this->voto_pesato = $row['voto_pesato'];
        $this->voto_tramite_delega = $row['voto_tramite_delega'];
        $this->scheda_bianca = $row['scheda_bianca'];
        $this->voto_per_sesso = $row['voto_per_sesso'];
        $this->risposta_testo_libero = $row['risposta_testo_libero'];
        $this->voto_a_sezione = $row['voto_a_sezione'];
        $this->archiviata = $row['archiviata'];
        $this->min_candidati = $row['min_candidati'];
        $this->min_liste = $row['min_liste'];
        $this->min_candidati_lista = $row['min_candidati_lista'];
        $this->min_proposte = $row['min_proposte'];
        $this->max_candidati = $row['max_candidati'];
        $this->max_liste = $row['max_liste'];
        $this->max_candidati_lista = $row['max_candidati_lista'];
        $this->max_proposte = $row['max_proposte'];
        $this->link = $row['link'];
        $this->tipo_votazione_id = $row['tipo_votazione_id'];
        $this->amministratore_username = $row['amministratore_username'];
    }

    // Read one votazione
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->assignProperties($row);
        }
    }

    // Update votazione
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
            codice_votazione = ?,
            titolo = ?,
            descrizione = ?,
            immagine = ?,
            inizio_votazione = ?,
            fine_votazione = ?,
            voto_segreto = ?,
            voto_disgiunto = ?,
            voto_pesato = ?,
            voto_tramite_delega = ?,
            scheda_bianca = ?,
            voto_per_sesso = ?,
            risposta_testo_libero = ?,
            voto_a_sezione = ?,
            archiviata = ?,
            min_candidati = ?,
            min_liste = ?,
            min_candidati_lista = ?,
            min_proposte = ?,
            max_candidati = ?,
            max_liste = ?,
            max_candidati_lista = ?,
            max_proposte = ?,
            link = ?,
            tipo_votazione_id = ?,
            amministratore_username = ?
            WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->sanitize();

        // bind values
        $stmt->bind_param('issssssiiiiiiiiiiiiiiiisssi',
            $this->codice_votazione,
            $this->titolo,
            $this->descrizione,
            $this->immagine,
            $this->inizio_votazione,
            $this->fine_votazione,
            $this->voto_segreto,
            $this->voto_disgiunto,
            $this->voto_pesato,
            $this->voto_tramite_delega,
            $this->scheda_bianca,
            $this->voto_per_sesso,
            $this->risposta_testo_libero,
            $this->voto_a_sezione,
            $this->archiviata,
            $this->min_candidati,
            $this->min_liste,
            $this->min_candidati_lista,
            $this->min_proposte,
            $this->max_candidati,
            $this->max_liste,
            $this->max_candidati_lista,
            $this->max_proposte,
            $this->link,
            $this->tipo_votazione_id,
            $this->amministratore_username,
            $this->id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>