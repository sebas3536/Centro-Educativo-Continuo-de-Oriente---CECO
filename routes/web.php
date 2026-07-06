<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':
        require '../resources/views/auth/login.php';
        break;

    case 'logout':
        require_once '../app/Controllers/AuthController.php';
        AuthController::logout();
        break;
    //Admin
    case 'admin_dashboard':
        require_once '../app/Middleware/AuthMiddleware.php';
        require_once '../app/Middleware/RoleMiddleware.php';
        RoleMiddleware::requireAdmin();
        require '../resources/views/admin/dashboard.php';
        break;

    case 'admin_programas':
        require_once '../app/Middleware/AuthMiddleware.php';
        require_once '../app/Middleware/RoleMiddleware.php';
        RoleMiddleware::requireAdmin();
        require '../resources/views/admin/programas/programas.php';
        break;

    case 'admin_multimedia':
        require_once '../app/Middleware/AuthMiddleware.php';
        require_once '../app/Middleware/RoleMiddleware.php';
        RoleMiddleware::requireAdmin();
        require '../resources/views/admin/multimedia.php';
        break;
    //Editor
    case 'editor_dashboard':
        require_once '../app/Middleware/AuthMiddleware.php';
        require_once '../app/Middleware/RoleMiddleware.php';
        RoleMiddleware::requireEditor();
        require '../resources/views/editor/dashboard.php';
        break;





    default:
        require '../resources/views/frontend/home.php';
        break;
}