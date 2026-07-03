<?php
class AuthMiddleware
{
    // Duración de sesión (30 minutos)
    private const SESSION_LIFETIME = 1800;

    public static function check(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']['id'])) {
            self::deny();
        }
        if (isset($_SESSION['last_activity'])) {
            $elapsed = time() - $_SESSION['last_activity'];
            if ($elapsed > self::SESSION_LIFETIME) {
                self::deny('expired');
            }
        }

        $_SESSION['last_activity'] = time();
    }

    /**
     * @param string $reason
     * @return never
     */
    private static function deny(string $reason = 'unauth'): void
    {
        session_unset();
        session_destroy();
        $url = $reason === 'expired'
            ? '/index.php?page=login&error=expired'
            : '/index.php?page=login';
        header("Location: $url");
        exit;
    }
}