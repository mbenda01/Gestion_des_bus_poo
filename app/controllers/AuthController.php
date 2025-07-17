<?php
require_once __DIR__ . '/../../core/Controller.php';

class AuthController extends Controller {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function loginPage() {
        $this->render('auth/login');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);

            $user = $this->userModel->getUserByLogin($login);

            if (!$user) {
                $this->render('auth/login', ['error' => 'Identifiant ou mot de passe incorrect.']);
                return;
            }

            if ($user['password'] === 'default') {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['profile_image'] = $user['profile_image'] ?? 'default.png';
                $_SESSION['change_password'] = true;

                header('Location: index.php?action=changePassword');
                exit;
            }

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['profile_image'] = $user['profile_image'] ?? 'default.png';
                $_SESSION['change_password'] = false;

                // Redirection selon rôle
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                $this->render('auth/login', ['error' => 'Identifiant ou mot de passe incorrect.']);
            }
        }
    }

    public function changePasswordPage() {
        $this->render('auth/change_password');
    }

    public function changePassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            if ($newPassword !== $confirmPassword || strlen($newPassword) < 4) {
                $this->render('auth/change_password', ['error' => 'Les mots de passe ne correspondent pas ou sont trop courts.']);
                return;
            }

            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $this->userModel->updatePassword($_SESSION['user_id'], $hash);
            $_SESSION['change_password'] = false;

            header('Location: index.php?action=dashboard');
            exit;
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    public function adminDashboard() {
        $data = ['title' => 'Tableau de bord Admin'];
        $this->render('dashboard/admin', $data);
    }

    public function parcDashboard() {
        $data = ['title' => 'Tableau de bord Parc'];
        $this->render('dashboard/parc', $data);
    }

    public function trajetDashboard() {
        $data = ['title' => 'Tableau de bord Trajet'];
        $this->render('dashboard/trajet', $data);
    }
}
