<?php
class BusModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getPaginated($limit, $offset) {
        $sql = "SELECT b.*, l.numero as ligne_numero 
                FROM bus b 
                LEFT JOIN lignes l ON b.ligne_id = l.id 
                ORDER BY b.id DESC 
                LIMIT :limit OFFSET :offset";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        return $this->connexion->query("SELECT COUNT(*) FROM bus")->fetchColumn();
    }

    public function getById($id) {
        $stmt = $this->connexion->prepare("SELECT * FROM bus WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->connexion->prepare("INSERT INTO bus 
            (immatriculation, type, kilometrage, nbre_places, etat, localisation, ligne_id, zone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['immatriculation'],
            $data['type'],
            $data['kilometrage'],
            $data['nbre_places'],
            $data['etat'],
            $data['localisation'],
            $data['ligne_id'],
            $data['zone']
        ]);
    }

    public function update($data) {
        $stmt = $this->connexion->prepare("UPDATE bus SET 
            immatriculation = ?, 
            type = ?, 
            kilometrage = ?, 
            nbre_places = ?, 
            etat = ?, 
            localisation = ?, 
            ligne_id = ?, 
            zone = ? 
            WHERE id = ?");
        $stmt->execute([
            $data['immatriculation'],
            $data['type'],
            $data['kilometrage'],
            $data['nbre_places'],
            $data['etat'],
            $data['localisation'],
            $data['ligne_id'],
            $data['zone'],
            $data['id']
        ]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM bus WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function getAll() {
        $sql = "SELECT b.*, l.numero as ligne_numero 
                FROM bus b 
                LEFT JOIN lignes l ON b.ligne_id = l.id 
                ORDER BY b.id DESC";
        return $this->connexion->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

}
