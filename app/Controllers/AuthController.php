<?php
require_once __DIR__ . '/../Models/Usuario.php';

class AuthController
{
    public static function login(string $email, string $password): true|string
    {
        $genericError = "Credenciales inválidas";

        $user = Usuario::findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return $genericError;
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nombre' => $user['nombre'],
            'email' => $user['email'],
            'rol_id' => (int) $user['rol_id'],
            'rol' => $user['rol_nombre'],
        ];


        $_SESSION['last_activity'] = time();

        return true;
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        session_destroy();
        header("Location: /index.php?page=login");
        exit;
    }
}