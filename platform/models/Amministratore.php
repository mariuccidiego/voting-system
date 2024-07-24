<?php
include 'Votazione.php';
class Amministratore {
    private $conn;
    private $table_name = "amministratore";

    public $username;
    public $nome;
    public $cognome;
    public $email;
    public $data_nascita;
    public $pwd;
    public $votazioni = [];

    public function __construct($db) {
        $this->conn = $db;
    }

    public static function createFromUsername($db, $username) {
        $instance = new self($db);
        $instance->username = $username;
        $instance->readOne();
        $instance->fetchVotazioni();
        return $instance;
    }

    public function sanitize() {
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cognome = htmlspecialchars(strip_tags($this->cognome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->data_nascita = htmlspecialchars(strip_tags($this->data_nascita));
        $this->pwd = htmlspecialchars(strip_tags($this->pwd));
    }

    public function assignProperties($row) {
        $this->username = $row['username'];
        $this->nome = $row['nome'];
        $this->cognome = $row['cognome'];
        $this->email = $row['email'];
        $this->data_nascita = $row['data_nascita'];
        $this->pwd = $row['pwd'];
    }

    // Read one amministratore
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $this->username);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->assignProperties($row);
        }
    }

    // Fetch votazioni for the amministratore
    public function fetchVotazioni() {
        $query = "SELECT * FROM votazione WHERE amministratore_username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $this->username);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $votazione = new Votazione($this->conn);
            $votazione->assignProperties($row);
            $this->votazioni[] = $votazione;
        }
    }

    // Update amministratore
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
            nome = ?,
            cognome = ?,
            email = ?,
            data_nascita = ?,
            pwd = ?
            WHERE username = ?";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->sanitize();

        // bind values
        $stmt->bind_param('ssssss', 
            $this->nome,
            $this->cognome,
            $this->email,
            $this->data_nascita,
            $this->pwd,
            $this->username
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
