<?php
class ArretModel {
    private $connexion;
    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAll() {
        $sql = "SELECT a.*, l.numero as ligne_numero FROM arrets a JOIN lignes l ON a.ligne_id = l.id";
        return $this->connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->connexion->prepare("INSERT INTO arrets (numero, nom, ligne_id, zone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['numero'], $data['nom'], $data['ligne_id'], $data['zone']]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM arrets WHERE id = ?");
        $stmt->execute([$id]);
    }
}
