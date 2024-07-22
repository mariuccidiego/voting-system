<?php

class Votante {
    private $conn;
    private $table_name = "votante";

    public $id;
    public $nome;
    public $cognome;
    public $username;
    public $pwd;
    public $email;
    public $ruolo;
    public $cf;
    public $peso_voto = 1;
    public $votato = false;
    public $votazione_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function sanitize() {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->cognome = htmlspecialchars(strip_tags($this->cognome));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->pwd = htmlspecialchars(strip_tags($this->pwd));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->ruolo = htmlspecialchars(strip_tags($this->ruolo));
        $this->cf = htmlspecialchars(strip_tags($this->cf));
        $this->peso_voto = htmlspecialchars(strip_tags($this->peso_voto));
        $this->votato = htmlspecialchars(strip_tags($this->votato));
        $this->votazione_id = htmlspecialchars(strip_tags($this->votazione_id));
    }

    public function assignProperties($row) {
        $this->id = $row['id'];
        $this->nome = $row['nome'];
        $this->cognome = $row['cognome'];
        $this->username = $row['username'];
        $this->pwd = $row['pwd'];
        $this->email = $row['email'];
        $this->ruolo = $row['ruolo'];
        $this->cf = $row['cf'];
        $this->peso_voto = $row['peso_voto'];
        $this->votato = $row['votato'];
        $this->votazione_id = $row['votazione_id'];
    }

    // Read all votanti
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Read one votante by id
    public function readFromId($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $this->assignProperties($row);
            return true;
        } else {
            return false;
        }
    }

    // Update votante
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
            nome = ?, cognome = ?, username = ?, pwd = ?, email = ?, ruolo = ?, cf = ?, peso_voto = ?, votato = ?, votazione_id = ?
            WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->sanitize();

        // bind values
        $stmt->bind_param('sssssssiisi', $this->nome, $this->cognome, $this->username, $this->pwd, $this->email, $this->ruolo, $this->cf, $this->peso_voto, $this->votato, $this->votazione_id, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
