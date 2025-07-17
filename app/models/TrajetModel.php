<?php
class TrajetModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getPaginated($limit, $offset) {
        $sql = "SELECT t.*, l.numero AS ligne_numero, b.immatriculation, c.prenom, c.nom 
                FROM trajets t 
                JOIN lignes l ON t.ligne_id = l.id
                JOIN bus b ON t.bus_id = b.id
                JOIN conducteurs c ON t.conducteur_id = c.id
                ORDER BY t.date DESC
                LIMIT :limit OFFSET :offset";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll() {
        return $this->connexion->query("SELECT COUNT(*) FROM trajets")->fetchColumn();
    }

    public function getById($id) {
        $sql = "SELECT * FROM trajets WHERE id = ?";
        $stmt = $this->connexion->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->connexion->prepare("INSERT INTO trajets (date, nbre_tickets_dispo, ligne_id, bus_id, conducteur_id, tarif) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['date'],
            $data['nbre_tickets_dispo'],
            $data['ligne_id'],
            $data['bus_id'],
            $data['conducteur_id'],
            $data['tarif']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->connexion->prepare("UPDATE trajets SET date = ?, nbre_tickets_dispo = ?, ligne_id = ?, bus_id = ?, conducteur_id = ?, tarif = ? WHERE id = ?");
        $stmt->execute([
            $data['date'],
            $data['nbre_tickets_dispo'],
            $data['ligne_id'],
            $data['bus_id'],
            $data['conducteur_id'],
            $data['tarif'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM trajets WHERE id = ?");
        $stmt->execute([$id]);
    }



}
