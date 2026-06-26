<?php
require_once __DIR__ . '/../../config/connection.php';

class Usuario
{

    private static function db()
    {
        return Database::getConnection();
    }
    public static function findByEmail($email)
    {
        $db = self::db();

        $sql = "SELECT u.*, r.nombre AS rol_nombre
                FROM usuarios u
                INNER JOIN roles r ON u.rol_id = r.id
                WHERE u.email = :email
                LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch();
    }
}