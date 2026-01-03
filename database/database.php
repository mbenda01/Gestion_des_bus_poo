<?php

class Database {
    private $connexion;

    private $host = 'iibs_postgres';
    private $port = 5432;
    private $dbname = 'gestiondesbuspoo';
    private $username = 'postgres';
    private $password = 'root';

    public function getConnexion() {
        if ($this->connexion === null) {
            try {
                $this->connexion = new PDO(
                    "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}",
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
