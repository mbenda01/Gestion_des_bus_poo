<?php
class ConducteurModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getPaginated($limit, $offset) {
        $stmt = $this->connexion->prepare("SELECT * FROM conducteurs ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        $stmt = $this->connexion->query("SELECT COUNT(*) FROM conducteurs");
        return $stmt->fetchColumn();
    }

    public function add($data) {
        $stmt = $this->connexion->prepare("
            INSERT INTO conducteurs (matricule, prenom, nom, telephone, type_permis, zone)
            VALUES (:matricule, :prenom, :nom, :telephone, :type_permis, :zone)
        ");
        $stmt->execute([
            ':matricule' => $data['matricule'],
            ':prenom' => $data['prenom'],
            ':nom' => $data['nom'],
            ':telephone' => $data['telephone'],
            ':type_permis' => $data['type_permis'],
            ':zone' => $data['zone'],
        ]);
    }

    public function getById($id) {
        $stmt = $this->connexion->prepare("SELECT * FROM conducteurs WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->connexion->prepare("
            UPDATE conducteurs
            SET matricule = :matricule,
                prenom = :prenom,
                nom = :nom,
                telephone = :telephone,
                type_permis = :type_permis,
                zone = :zone
            WHERE id = :id
        ");
        $stmt->execute([
            ':matricule' => $data['matricule'],
            ':prenom' => $data['prenom'],
            ':nom' => $data['nom'],
            ':telephone' => $data['telephone'],
            ':type_permis' => $data['type_permis'],
            ':zone' => $data['zone'],
            ':id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM conducteurs WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
     public function getAll() {
        $stmt = $this->connexion->prepare("SELECT * FROM conducteurs");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
