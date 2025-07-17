<?php
class LigneModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAll() {
        $stmt = $this->connexion->prepare("SELECT * FROM lignes ORDER BY numero ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset) {
        $stmt = $this->connexion->prepare("SELECT * FROM lignes ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        return $this->connexion->query("SELECT COUNT(*) FROM lignes")->fetchColumn();
    }

    public function add($numero, $tarif) {
        $stmt = $this->connexion->prepare("INSERT INTO lignes (numero, tarif) VALUES (?, ?)");
        $stmt->execute([$numero, $tarif]);
    }

    public function getById($id) {
        $stmt = $this->connexion->prepare("SELECT * FROM lignes WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $numero, $tarif) {
        $stmt = $this->connexion->prepare("UPDATE lignes SET numero = ?, tarif = ? WHERE id = ?");
        $stmt->execute([$numero, $tarif, $id]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM lignes WHERE id = ?");
        $stmt->execute([$id]);
    }
}
