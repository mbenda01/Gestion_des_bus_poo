<?php

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->loginPage();
        }
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'changePassword':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->changePassword();
        } else {
            $authController->changePasswordPage();
        }
        break;
    case 'storePassword':
        $authController->storePassword();
        break;

    case 'home':
    case 'dashboard':
        Middleware::checkAuth();
        $role = $_SESSION['role'] ?? null;
        
        if (!$role) {
            $authController->logout();
            break;
        }
        
        Middleware::redirectByRole($role);
        break;

    case 'adminDashboard':
        Middleware::checkAuth();
        if ($_SESSION['role'] == 1) {
            $authController->adminDashboard();
        } else {
            $authController->logout();
        }
        break;

    case 'parcDashboard':
        Middleware::checkAuth();
        if ($_SESSION['role'] == 2) {
            $authController->parcDashboard();
        } else {
            $authController->logout();
        }
        break;

    case 'trajetDashboard':
        Middleware::checkAuth();
        if ($_SESSION['role'] == 3) {
            $authController->trajetDashboard();
        } else {
            $authController->logout();
        }
        break;


    case 'users':
        $userController->index();
        break;
    case 'addUser':
        $userController->addForm();
        break;
    case 'storeUser':
        $userController->store();
        break;
    case 'editUser':
        $userController->editForm();
        break;
    case 'updateUser':
        $userController->update();
        break;
    case 'deleteUser':
        $userController->delete();
        break;

    case 'bus':
        $busController->index();
        break;
    case 'addBus':
        $busController->addForm();
        break;
    case 'storeBus':
        $busController->store();
        break;
    case 'editBus':
        $busController->editForm();
        break;
    case 'updateBus':
        $busController->update();
        break;
    case 'deleteBus':
        $busController->delete();
        break;

    case 'conducteurs':
        $conducteurController->index();
        break;
    case 'addConducteur':
        $conducteurController->addForm();
        break;
    case 'storeConducteur':
        $conducteurController->store();
        break;
    case 'editConducteur':
        $conducteurController->editForm();
        break;
    case 'updateConducteur':
        $conducteurController->update();
        break;
    case 'deleteConducteur':
        $conducteurController->delete();
        break;

    case 'lignes':
        $ligneController->index();
        break;
    case 'addLigne':
        $ligneController->addForm();
        break;
    case 'storeLigne':
        $ligneController->store();
        break;
    case 'editLigne':
        $ligneController->editForm();
        break;
    case 'updateLigne':
        $ligneController->update();
        break;
    case 'deleteLigne':
        $ligneController->delete();
        break;

    case 'arrets':
        $arretController->index();
        break;
    case 'addArret':
        $arretController->addForm();
        break;
    case 'storeArret':
        $arretController->store();
        break;
    case 'editArret':
        $arretController->editForm();
        break;
    case 'updateArret':
        $arretController->update();
        break;
    case 'deleteArret':
        $arretController->delete();
        break;

    case 'trajets':
        $trajetController->index();
        break;
    case 'addTrajet':
        $trajetController->addForm();
        break;
    case 'storeTrajet':
        $trajetController->store();
        break;
    case 'editTrajet':
        $trajetController->editForm();
        break;
    case 'updateTrajet':
        $trajetController->update();
        break;
    case 'deleteTrajet':
        $trajetController->delete();
        break;
    case 'roles':
        $roleController->index();
        break;
    case 'addRole':
        $roleController->addForm();
        break;
    case 'storeRole':
        $roleController->store();
        break;
    case 'editRole':
        $roleController->editForm();
        break;
    case 'updateRole':
        $roleController->update();
        break;
    case 'deleteRole':
        $roleController->delete();
        break;

    case 'clientDashboard':
        Middleware::checkAuth();
        if ($_SESSION['role'] == 4) {
            $clientController->dashboard();
        } else {
            $authController->logout();
        }
        break;
    case 'reserver':
        $clientController->formReservation();
        break;
    case 'storeReservation':
        $clientController->reserver();
        break;
    case 'historiqueReservations':
        $clientController->historique();
        break;
    case 'notifications':
        $clientController->notifications();
        break;
    case 'paiementTicket':
        $clientController->paiement();
        break;


    default:
        echo "Action inconnue.";
        break;
}
