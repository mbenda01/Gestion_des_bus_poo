<?php
class RoleController extends Controller {
    private $roleModel;

    public function __construct($roleModel) {
        $this->roleModel = $roleModel;
    }

    public function index() {
        Middleware::checkAuth();
        $page = $_GET['page'] ?? 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $roles = $this->roleModel->getPaginated($limit, $offset);
        $total = $this->roleModel->countAll();
        $totalPages = ceil($total / $limit);
        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('roles/liste', compact('roles', 'page', 'totalPages', 'start', 'end', 'total'));
    }

    public function addForm() {
        Middleware::checkAuth();
        $this->render('roles/add');
    }

    public function store() {
        Middleware::checkAuth();
        $libelle = trim($_POST['libelle']);

        if (empty($libelle)) {
            $this->redirect('index.php?action=addRole&error=empty');
            return;
        }

        $this->roleModel->create($libelle);
        $this->redirect('index.php?action=roles&success=added');
    }

    public function editForm() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('index.php?action=roles');
            return;
        }

        $role = $this->roleModel->getById($id);

        if (!$role) {
            $this->redirect('index.php?action=roles&error=notfound');
            return;
        }

        $this->render('roles/edit', compact('role'));
    }

    public function update() {
        Middleware::checkAuth();
        $id = $_POST['id'] ?? null;
        $libelle = trim($_POST['libelle']);

        if (!$id || empty($libelle)) {
            $this->redirect("index.php?action=editRole&id=$id&error=invalid");
            return;
        }

        $this->roleModel->update($id, $libelle);
        $this->redirect('index.php?action=roles&success=updated');
    }

    public function delete() {
        Middleware::checkAuth();
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->redirect('index.php?action=roles&error=invalid');
            return;
        }

        $this->roleModel->delete($id);
        $this->redirect('index.php?action=roles&success=deleted');
    }
}
