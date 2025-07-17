<?php
require_once __DIR__ . '/../../core/Controller.php';

class BusController extends Controller {
    private $busModel;
    private $ligneModel;

    public function __construct($busModel, $ligneModel) {
        $this->busModel = $busModel;
        $this->ligneModel = $ligneModel;
    }

    public function index() {
        Middleware::checkAuth();

        $limit = 10;
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;

        $buses = $this->busModel->getPaginated($limit, $offset);
        $total = $this->busModel->countAll();
        $totalPages = max(1, ceil($total / $limit));
        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('bus/liste', compact('buses', 'page', 'totalPages', 'start', 'end', 'total'));
    }

    public function addForm() {
        Middleware::checkAuth();
        $lignes = $this->ligneModel->getAll();
        $this->render('bus/add', ['lignes' => $lignes, 'tittle' => "Ajouter un bus"]);
    }

    public function store() {
        Middleware::checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->busModel->add($_POST);
            header('Location: index.php?action=bus');
            exit;
        }
    }

    public function editForm() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=buses&error=invalid');
            exit;
        }

        $bus = $this->busModel->getById($id);
        $lignes = $this->ligneModel->getAll();

        if (!$bus) {
            header('Location: index.php?action=buses&error=notfound');
            exit;
        }

        $this->render('bus/edit', ['bus' => $bus, 'lignes' => $lignes, 'tittle' => "Modifier un bus"]);
    }

    public function update() {
        Middleware::checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->busModel->update($_POST);
            header('Location: index.php?action=buses&updated=1');
            exit;
        }
    }

    public function delete() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=buses&error=invalid');
            exit;
        }

        $this->busModel->delete($id);
        header('Location: index.php?action=buses&deleted=1');
        exit;
    }
}
