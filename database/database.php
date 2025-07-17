<?php

class Database {
    private $connexion;
    private $host = 'localhost';
    private $dbname = 'gestiondesbuspoo';
    private $username = 'root';
    private $password = '';

    public function getConnexion() {
        if ($this->connexion === null) {
            try {
                $this->connexion = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return $this->connexion;
    }
}
