<?php
require_once __DIR__ . '/../../config/connection.php';

class Dashboard
{
    private static function db(): PDO
    {
        return Database::getConnection();
    }

    public static function getEstadisticas(): array
    {
        $db = self::db();

        // Programas por estado
        $stmt = $db->query("
            SELECT estado, COUNT(*) AS total
            FROM programas
            GROUP BY estado
        ");
        $programas = ['activo' => 0, 'inactivo' => 0, 'borrador' => 0];
        foreach ($stmt->fetchAll() as $row) {
            $programas[$row['estado']] = (int)$row['total'];
        }
        $programas['total'] = array_sum($programas);

        // Multimedia
        $stmt = $db->query("
            SELECT COUNT(*) AS total, COALESCE(SUM(peso_bytes), 0) AS peso_total
            FROM multimedia_fotos
        ");
        $multimedia = $stmt->fetch();

        return [
            'programas'  => $programas,
            'multimedia' => [
                'total'      => (int)$multimedia['total'],
                'peso_total' => self::formatBytes((int)$multimedia['peso_total']),
            ],
        ];
    }

    private static function formatBytes(int $bytes): string
    {
        if ($bytes >= 1_048_576) return round($bytes / 1_048_576, 1) . ' MB';
        if ($bytes >= 1_024)    return round($bytes / 1_024, 1) . ' KB';
        return $bytes . ' B';
    }
}