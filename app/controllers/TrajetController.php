<?php
require_once __DIR__ . '/../../core/Controller.php';

class TrajetController extends Controller {
    private $trajetModel;
    private $ligneModel;
    private $busModel;
    private $conducteurModel;

    public function __construct($trajetModel, $ligneModel, $busModel, $conducteurModel) {
        $this->trajetModel = $trajetModel;
        $this->ligneModel = $ligneModel;
        $this->busModel = $busModel;
        $this->conducteurModel = $conducteurModel;
    }

    public function index() {
        Middleware::checkAuth();

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $trajets = $this->trajetModel->getPaginated($limit, $offset);
        $total = $this->trajetModel->countAll();
        $totalPages = max(1, ceil($total / $limit));
        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('trajets/liste', compact('trajets', 'page', 'totalPages', 'start', 'end', 'total'));
    }

    public function addForm() {
        Middleware::checkAuth();
        $lignes = $this->ligneModel->getAll();
        $buses = $this->busModel->getAll();
        $conducteurs = $this->conducteurModel->getAll();

        $this->render('trajets/add', [
            'lignes' => $lignes,
            'buses' => $buses,
            'conducteurs' => $conducteurs,
            'tittle' => 'Ajouter un trajet'
        ]);
    }

    public function store() {
        Middleware::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=trajets');
            exit;
        }

        $data = $_POST;
        $this->trajetModel->add($data);

        header('Location: index.php?action=trajets&added=1');
        exit;
    }

    public function delete() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=trajets&error=invalid');
            exit;
        }

        $this->trajetModel->delete($id);
        header('Location: index.php?action=trajets&deleted=1');
        exit;
    }
}
