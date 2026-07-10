<?php
$scriptName = $_SERVER['SCRIPT_NAME'] ?? $_SERVER['PHP_SELF'] ?? '';
$baseDir = dirname($scriptName);
$baseDir = str_replace('\\', '/', $baseDir);
if ($baseDir === '/' || $baseDir === '\\' || $baseDir === '') {
    $baseDir = '/';
} else {
    $baseDir = rtrim($baseDir, '/') . '/';
}
define('BASE_URL', $baseDir);

require_once __DIR__ . '/config/connection.php';
require_once __DIR__ . '/app/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/app/Middleware/RoleMiddleware.php';
require_once __DIR__ . '/app/Controllers/AuthController.php';

// Punto de entrada limpio — NADA de HTML aquí arriba
$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'login':
        require __DIR__ . '/resources/views/auth/login.php';
        break;

    case 'login_process':
        require __DIR__ . '/public/login_process.php';
        break;

    case 'logout':
        AuthController::logout();
        break;
    // Admin 
    case 'admin_dashboard':
        RoleMiddleware::requireAdmin();
        require __DIR__ . '/resources/views/admin/dashboard.php';
        break;

    case 'admin_programas':
        RoleMiddleware::requireAdmin();
        require_once __DIR__ . '/app/Models/Programa.php';
        require_once __DIR__ . '/app/Controllers/ProgramaController.php';
        $controller = new ProgramaController();
        $action = $_GET['action'] ?? '';

        switch ($action) {

            case 'index':
            case '':
                $controller->index();
                break;

            case 'nuevo':
                $controller->create();
                break;

            case 'guardar':
                $controller->store($_POST, $_FILES);
                break;

            case 'editar':
                $id = $_GET['id'] ?? null;
                $controller->edit($id);
                break;

            case 'actualizar':
                $id = (int) ($_GET['id'] ?? 0);
                $controller->update($id, $_POST, $_FILES);
                break;

            case 'eliminar':
                $id = $_GET['id'] ?? null;
                $controller->delete($id);
                break;
        }

        break;


    case 'admin_multimedia':
        RoleMiddleware::requireAdmin();
        require_once __DIR__ . '/app/Models/Multimedia.php';
        require_once __DIR__ . '/app/Controllers/MultimediaController.php';

        $action = $_GET['action'] ?? '';
        $programaId = (int) ($_GET['programa_id'] ?? 0);

        switch ($action) {

            case 'guardar':
                try {
                    MultimediaController::store($_POST, $_FILES['imagen']);
                    $_SESSION['multimedia_ok'] = 'Imagen subida correctamente.';
                } catch (Exception $e) {
                    $_SESSION['multimedia_error'] = $e->getMessage();
                }
                header("Location: ?page=admin_multimedia&programa_id={$programaId}");
                exit;

            case 'actualizar':
                try {
                    $id = (int) $_POST['id'];
                    $file = !empty($_FILES['imagen']['tmp_name']) ? $_FILES['imagen'] : null;
                    MultimediaController::update($id, $_POST, $file);
                    $_SESSION['multimedia_ok'] = 'Imagen actualizada correctamente.';
                } catch (Exception $e) {
                    $_SESSION['multimedia_error'] = $e->getMessage();
                }
                header("Location: ?page=admin_multimedia&programa_id={$programaId}");
                exit;

            case 'eliminar':
                $id = (int) $_POST['id'];
                MultimediaController::destroy($id);
                $_SESSION['multimedia_ok'] = 'Imagen eliminada.';
                header("Location: ?page=admin_multimedia&programa_id={$programaId}");
                exit;

            default:
                require __DIR__ . '/resources/views/admin/multimedia.php';
                break;
        }
        break;

    // Editor
    case 'editor_dashboard':
        RoleMiddleware::requireEditor();
        require __DIR__ . '/resources/views/editor/dashboard.php';
        break;

    case 'programas':
        require_once __DIR__ . '/app/Models/Programa.php';
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        $controller = new HomeController();
        $controller->todos();
        break;

    case 'home':
    default:
        require_once __DIR__ . '/app/Models/Programa.php';
        require_once __DIR__ . '/app/Controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
}
?>