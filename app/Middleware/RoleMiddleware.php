<?php
class RoleMiddleware
{
    public static function requireAdmin(): void
    {
        AuthMiddleware::check();
        if ((int)$_SESSION['user']['rol_id'] !== 1) {
            http_response_code(403);
            exit("403 - Acceso denegado");
        }
    }

    public static function requireEditor(): void
    {
        AuthMiddleware::check();

        if (!in_array((int)$_SESSION['user']['rol_id'], [1, 2], true)) {
            http_response_code(403);
            exit("403 - Acceso denegado");
        }
    }
}