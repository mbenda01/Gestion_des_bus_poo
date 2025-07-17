<?php

class Controller {

    /**
     * Affiche une vue avec des données optionnelles.
     *
     * @param string $view - chemin relatif dans app/views sans extension `.php`
     * @param array $data - tableau associatif contenant les données à transmettre à la vue
     */
    public function render($view, $data = []) {
        extract($data);
        ob_start();
        require_once __DIR__ . '/../app/views/' . $view . '.php';
        $content = ob_get_clean();
        echo $content;
    }

    protected function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function verifyCsrfToken() {
        $token = $_POST['csrf_token'] ?? '';
        if (!hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            die('Erreur CSRF token invalide');
        }
    }
}
