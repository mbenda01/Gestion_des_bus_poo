<?php
require_once __DIR__ . '/../../core/Controller.php';

class ConducteurController extends Controller {
    private $conducteurModel;

    public function __construct($conducteurModel) {
        $this->conducteurModel = $conducteurModel;
    }

    public function index() {
        Middleware::checkAuth();

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $conducteurs = $this->conducteurModel->getPaginated($limit, $offset);
        $total = $this->conducteurModel->countAll();
        $totalPages = max(1, ceil($total / $limit));
        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('conducteurs/liste', compact('conducteurs', 'page', 'totalPages', 'start', 'end', 'total'));
    }

    public function addForm() {
        Middleware::checkAuth();
        $this->render('conducteurs/add', ['tittle' => 'Ajouter un conducteur']);
    }

    public function store() {
        Middleware::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=conducteurs');
            exit;
        }

        $data = $_POST;
        $this->conducteurModel->add($data);

        // Redirection après ajout
        header('Location: index.php?action=conducteurs&added=1');
        exit;
    }

    public function editForm() {
        Middleware::checkAuth();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=conducteurs');
            exit;
        }

        $conducteur = $this->conducteurModel->getById($id);
        if (!$conducteur) {
            header('Location: index.php?action=conducteurs&error=notfound');
            exit;
        }

        $this->render('conducteurs/edit', compact('conducteur'));
    }

    public function update() {
        Middleware::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;

            if (!$id || empty($_POST['prenom']) || empty($_POST['nom'])) {
                header("Location: index.php?action=editConducteur&id=$id&error=invalid");
                exit;
            }

            $this->conducteurModel->update($id, $_POST);
            header('Location: index.php?action=conducteurs&updated=1');
            exit;
        }
    }

    public function delete() {
        Middleware::checkAuth();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=conducteurs&error=invalid');
            exit;
        }

        $this->conducteurModel->delete($id);
        header('Location: index.php?action=conducteurs&deleted=1');
        exit;
    }
}
