<?php
class RoleModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAll() {
        $stmt = $this->connexion->query("SELECT * FROM roles ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset) {
        $stmt = $this->connexion->prepare("SELECT * FROM roles ORDER BY id ASC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->connexion->query("SELECT COUNT(*) FROM roles");
        return $stmt->fetchColumn();
    }

    public function create($libelle) {
        $stmt = $this->connexion->prepare("INSERT INTO roles (libelle) VALUES (:libelle)");
        $stmt->execute([':libelle' => $libelle]);
    }

    public function getById($id) {
        $stmt = $this->connexion->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $libelle) {
        $stmt = $this->connexion->prepare("UPDATE roles SET libelle = :libelle WHERE id = :id");
        $stmt->execute([
            ':libelle' => $libelle,
            ':id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM roles WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
