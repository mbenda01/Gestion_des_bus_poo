<?php
require_once __DIR__ . '/../../core/Controller.php';

class UserController extends Controller {
    private $userModel;
    private $roleModel;

    public function __construct($userModel, $roleModel) {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
    }
    
    public function index() {
        Middleware::checkAuth();

        $limit = 3;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;

        $users = $this->userModel->getUsersByPage($limit, $offset);
        $total = $this->userModel->countUsers();
        $totalPages = max(1, ceil($total / $limit));

        $start = $offset + 1;
        $end = min($offset + $limit, $total);

        $this->render('users/liste', [
            'users' => $users,
            'page' => $page,
            'totalPages' => $totalPages,
            'total' => $total,
            'start' => $start,
            'end' => $end
        ]);
    }




    public function addForm()
    {
        $roles = $this->roleModel->getAll();
        
        $this->render('users/add', [
            'roles' => $roles,
            'tittle' => 'Ajouter un utilisateur'
        ]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?action=listUsers');
            exit;
        }

        $data = $_POST;
        
        $profileImage = 'default.png';
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/profiles/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $extension;
            
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadDir . $filename)) {
                $profileImage = $filename;
            }
        }
        
        $data['profile_image'] = $profileImage;
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $userId = $this->userModel->add($data);
        
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $newUser = $this->userModel->getById($userId);
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'user' => [
                    'id' => $newUser['id'],
                    'prenom' => $newUser['prenom'],
                    'nom' => $newUser['nom'],
                    'login' => $newUser['login'],
                    'telephone' => $newUser['telephone'],
                    'role' => $newUser['role'],
                    'libelle' => $this->getRoleLabel($newUser['role'])
                ]
            ]);
            exit;
        }
        
       header('Location: index.php?action=users&added=1');
        exit;
    }

    public function editForm() {
        $id = $_GET['id'];
        $user = $this->userModel->getById($id);
        $roles = $this->roleModel->getAll();
        $this->render('users/edit', ['user' => $user, 'roles' => $roles, 'tittle' => "Modifier utilisateur"]);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $this->userModel->update($data);
            header('Location: index.php?action=users');
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $this->userModel->delete($id);
        header('Location: index.php?action=users');
        exit;
    }

    
}
