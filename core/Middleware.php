<?php

class Middleware {
    public static function checkAuth() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if (isset($_SESSION['change_password']) && $_SESSION['change_password'] === true) {
            header('Location: index.php?action=changePassword');
            exit;
        }
    }

    public static function redirectByRole($roleId) {
        switch ($roleId) {
            case 1:
                header('Location: index.php?action=adminDashboard');
                break;
            case 2:
                header('Location: index.php?action=parcDashboard');
                break;
            case 3:
                header('Location: index.php?action=trajetDashboard');
                break;
            case 4:
                header('Location: index.php?action=clientDashboard');
                break;

            default:
                header('Location: index.php?action=login');
        }
        exit;
    }
}
