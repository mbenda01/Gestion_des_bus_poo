<?php
session_start();

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Middleware.php';
require_once __DIR__ . '/../database/database.php';


$db = new Database();
$connexion = $db->getConnexion();


require_once __DIR__ . '/../app/models/UserModel.php';
require_once __DIR__ . '/../app/models/RoleModel.php';
require_once __DIR__ . '/../app/models/BusModel.php';
require_once __DIR__ . '/../app/models/ConducteurModel.php';
require_once __DIR__ . '/../app/models/LigneModel.php';
require_once __DIR__ . '/../app/models/ArretModel.php';
require_once __DIR__ . '/../app/models/TrajetModel.php';
require_once __DIR__ . '/../app/models/ClientModel.php';

require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../app/controllers/BusController.php';
require_once __DIR__ . '/../app/controllers/ConducteurController.php';
require_once __DIR__ . '/../app/controllers/LigneController.php';
require_once __DIR__ . '/../app/controllers/ArretController.php';
require_once __DIR__ . '/../app/controllers/TrajetController.php';
require_once __DIR__ . '/../app/controllers/RoleController.php';
require_once __DIR__ . '/../app/controllers/ClientController.php';

$userModel = new UserModel($connexion);
$roleModel = new RoleModel($connexion);
$busModel = new BusModel($connexion);
$conducteurModel = new ConducteurModel($connexion);
$ligneModel = new LigneModel($connexion);
$arretModel = new ArretModel($connexion);
$trajetModel = new TrajetModel($connexion);
$clientModel = new ClientModel($connexion);

$authController = new AuthController($userModel);
$userController = new UserController($userModel, $roleModel);
$busController = new BusController($busModel, $ligneModel);
$conducteurController = new ConducteurController($conducteurModel);
$ligneController = new LigneController($ligneModel);
$arretController = new ArretController($arretModel, $ligneModel);
$trajetController = new TrajetController($trajetModel, $ligneModel, $busModel, $conducteurModel);
$roleController = new RoleController($roleModel);
$clientController = new ClientController($clientModel);

require_once __DIR__ . '/../routes.php';
