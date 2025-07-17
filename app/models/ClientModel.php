<?php
class ClientModel {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function reserver($data) {
        $stmt = $this->connexion->prepare("INSERT INTO reservations (user_id, ligne, type_trajet, arret_depart, arret_arrivee, prix) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_SESSION['user_id'],
            $data['ligne'],
            $data['type_trajet'],
            $data['arret_depart'],
            $data['arret_arrivee'],
            $data['prix']
        ]);
    }

    public function getReservationsByUser($userId) {
        $stmt = $this->connexion->prepare("SELECT * FROM reservations WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotificationsFictives() {
        return [
            "🚍 Votre bus est en route, veuillez vous rendre à l'arrêt dans 10 minutes.",
            "🕒 Attention : Trafic dense signalé sur votre ligne habituelle.",
            "🎉 Promo spéciale : 50 FCFA de réduction sur les trajets ce vendredi !"
        ];
    }
}
