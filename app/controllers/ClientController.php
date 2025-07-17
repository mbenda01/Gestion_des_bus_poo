<?php
class ClientController extends Controller {
    private $clientModel;

    public function __construct($clientModel) {
        $this->clientModel = $clientModel;
    }

    public function dashboard() {
        Middleware::checkAuth();
        $this->render('dashboard/client');
    }

    public function formReservation() {
        Middleware::checkAuth();
        $this->render('client/reserver');
    }

    public function reserver() {
        Middleware::checkAuth();
        $data = $_POST;
        $data['prix'] = in_array($data['arret_arrivee'], ['']) ? 0 : $data['prix'];
        $this->clientModel->reserver($data);
        $_SESSION['prix_ticket'] = $data['prix'];
        $this->render('client/paiement');
    }

    public function historique() {
        Middleware::checkAuth();
        $reservations = $this->clientModel->getReservationsByUser($_SESSION['user_id']);
        $this->render('client/historique', compact('reservations'));
    }

    public function notifications() {
        Middleware::checkAuth();
        $notifications = $this->clientModel->getNotificationsFictives();
        $this->render('client/notifications', compact('notifications'));
    }

    public function paiement() {
        Middleware::checkAuth();
        $this->render('client/paiement');
    }
}
