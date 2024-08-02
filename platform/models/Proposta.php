<?php

class Proposta
{
    private $conn;
    private $table_name = "proposta";

    public $id;
    public $titolo;
    public $desc_corta = null;
    public $descrizione = null;
    public $logo = null;
    public $votazione_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function sanitize() {
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->titolo = htmlspecialchars(strip_tags($this->titolo));
        $this->desc_corta = htmlspecialchars(strip_tags($this->desc_corta));
        $this->descrizione = htmlspecialchars(strip_tags($this->descrizione));
        $this->logo = htmlspecialchars(strip_tags($this->logo));
        $this->votazione_id = htmlspecialchars(strip_tags($this->votazione_id));
    }

    public function assignProperties($row) {
        $this->id = $row['id'];
        $this->titolo = $row['titolo'];
        $this->desc_corta = $row['desc_corta'];
        $this->descrizione = $row['descrizione'];
        $this->logo = $row['logo'];
        $this->votazione_id = $row['votazione_id'];
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

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

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET
            titolo = ?, desc_corta = ?, descrizione = ?, logo = ?, votazione_id = ?
            WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->sanitize();

        $stmt->bind_param('ssssii', $this->titolo, $this->desc_corta, $this->descrizione, $this->logo, $this->votazione_id, $this->id);

        return $stmt->execute();
    }

    public function create() {
        $this->sanitize();

        $query = "INSERT INTO " . $this->table_name . " (titolo, desc_corta, descrizione, logo, votazione_id)
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('ssssi', $this->titolo, $this->desc_corta, $this->descrizione, $this->logo, $this->votazione_id);

        return $stmt->execute();
    }

    public function deleteFromId($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }
}
