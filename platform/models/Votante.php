<?php

class Votante
{
    private $conn;
    private $table_name = "votante";

    public $id;
    public $nome;
    public $cognome;
    public $username;
    public $pwd;
    public $email;
    public $ruolo = null;
    public $cf = null;
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
    public function readFromUser($user) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $user);
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
        // Generate a username
        $this->username = $this->generateUsername();

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

    public function create() {
        // Generate an 8-character random password
        $this->pwd = $this->generateRandomPassword(8);

        // Generate a username
        $this->username = $this->generateUsername();

        // Sanitize data
        $this->sanitize();

        // SQL query to insert the new voter
        $query = "INSERT INTO " . $this->table_name . " (nome, cognome, username, pwd, email, ruolo, cf, peso_voto, votato, votazione_id)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        // Bind values
        $stmt->bind_param('sssssssiis', $this->nome, $this->cognome, $this->username, $this->pwd, $this->email, $this->ruolo, $this->cf, $this->peso_voto, $this->votato, $this->votazione_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Helper method to generate a random password
    private function generateRandomPassword($length = 8) {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $password;
    }

    // Helper method to generate a username
    private function generateUsername() {
        $prefix = '';
        if (!empty($this->nome)) {
            // Use the entire 'nome' if it's less than 3 characters, otherwise use the first 3 characters
            $prefix = substr($this->nome, 0, min(3, strlen($this->nome))) . '-';
        }

        // Replace spaces with hyphens in 'cognome'
        $surname = str_replace(' ', '-', $this->cognome);
        // Generate a random 3-digit number
        $randomNumber = random_int(100, 999);

        // Construct the username and convert it to lowercase
        $username = $prefix . $surname . '-' . $randomNumber;

        return strtolower($username);
    }


    public function deleteFromId($id) {
        // Prepare the query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // Prepare the statement
        $stmt = $this->conn->prepare($query);
    
        // Bind the ID parameter
        $stmt->bind_param('i', $id);
    
        // Execute the query and return the result
        return $stmt->execute();
    }


}
