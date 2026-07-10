<?php
require_once __DIR__ . '/../app/Controllers/AuthController.php';


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ?page=login");
    exit;
}
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

if (!$email || empty($password)) {
    header("Location: ?page=login&error=1");
    exit;
}

$result = AuthController::login($email, $password);

if ($result === true) {
    $rolId = (int) $_SESSION['user']['rol_id'];

    $redirects = [
        1 => '?page=admin_dashboard',
        2 => '?page=editor_dashboard',
    ];

    $url = $redirects[$rolId] ?? '?page=login&error=1';
    header("Location: $url");
    exit;
}

header("Location: ?page=login&error=1");
exit;