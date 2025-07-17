<?php
require_once __DIR__ . '/../../core/Controller.php';

class LigneController extends Controller {
    private $ligneModel;

    public function __construct($ligneModel) {
        $this->ligneModel = $ligneModel;
    }

    public function index() {
        Middleware::checkAuth();

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $lignes = $this->ligneModel->getPaginated($limit, $offset);
        $total = $this->ligneModel->countAll();
        $totalPages = max(1, ceil($total / $limit));
        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('lignes/liste', compact('lignes', 'page', 'totalPages', 'start', 'end', 'total'));
    }

    public function addForm() {
        Middleware::checkAuth();
        $this->render('lignes/add', ['tittle' => 'Ajouter une ligne']);
    }

    public function store() {
        Middleware::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $numero = trim($_POST['numero']);
            $tarif = trim($_POST['tarif']);

            if ($numero && is_numeric($tarif)) {
                $this->ligneModel->add($numero, $tarif);
                header('Location: index.php?action=lignes&added=1');
                exit;
            } else {
                header('Location: index.php?action=addLigne&error=invalid');
                exit;
            }
        }
    }

    public function editForm() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            header('Location: index.php?action=lignes');
            exit;
        }

        $ligne = $this->ligneModel->getById($id);

        if (!$ligne) {
            header('Location: index.php?action=lignes&error=notfound');
            exit;
        }

        $this->render('lignes/edit', ['ligne' => $ligne, 'tittle' => 'Modifier la ligne']);
    }

    public function update() {
        Middleware::checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $numero = trim($_POST['numero']);
            $tarif = trim($_POST['tarif']);

            if ($id && $numero && is_numeric($tarif)) {
                $this->ligneModel->update($id, $numero, $tarif);
                header('Location: index.php?action=lignes&updated=1');
                exit;
            } else {
                header("Location: index.php?action=editLigne&id=$id&error=invalid");
                exit;
            }
        }
    }

    public function delete() {
        Middleware::checkAuth();

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->ligneModel->delete($id);
            header('Location: index.php?action=lignes&deleted=1');
            exit;
        }

        header('Location: index.php?action=lignes&error=invalid');
        exit;
    }
}
