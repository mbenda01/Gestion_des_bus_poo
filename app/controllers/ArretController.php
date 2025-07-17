<?php
require_once __DIR__ . '/../../core/Controller.php';


class ArretController extends Controller {
    private $arretModel;
    private $ligneModel;

    public function __construct($arretModel, $ligneModel) {
        $this->arretModel = $arretModel;
        $this->ligneModel = $ligneModel;
    }

    public function index() {
        $arrets = $this->arretModel->getAll();
        $this->render('arrets/liste', ['arrets' => $arrets, 'tittle' => 'Liste des arrêts']);
    }

    public function addForm() {
        $lignes = $this->ligneModel->getAll();
        $this->render('arrets/add', ['lignes' => $lignes, 'tittle' => 'Ajouter un arrêt']);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->arretModel->add($_POST);
            header('Location: index.php?action=arrets');
            exit;
        }
    }

    public function delete() {
        $id = $_GET['id'];
        $this->arretModel->delete($id);
        header('Location: index.php?action=arrets');
        exit;
    }
}
