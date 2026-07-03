<?php

require_once __DIR__ . '/../../config/connection.php';

class Programa
{
    private static function db()
    {
        return Database::getConnection();
    }

    private static function normalizeEstado($estado)
    {
        $estado = $estado ?? 'borrador';

        if (!in_array($estado, ['activo', 'inactivo', 'borrador'])) {
            return 'borrador';
        }

        return $estado;
    }

    /* Listar */
    public static function getAll(): array
    {
        $stmt = self::db()->prepare("
        SELECT p.*,
               (SELECT mf.ruta_archivo
                FROM multimedia_fotos mf
                WHERE mf.programa_id = p.id AND mf.es_principal = 1
                LIMIT 1) AS imagen_principal
        FROM programas p
        ORDER BY p.fecha_creacion DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * @param mixed $id
     * @return array|false
     */
    public static function find($id)
    {
        $stmt = self::db()->prepare("
        SELECT p.*,
               (SELECT mf.ruta_archivo
                FROM multimedia_fotos mf
                WHERE mf.programa_id = p.id AND mf.es_principal = 1
                LIMIT 1) AS imagen_principal
        FROM programas p
        WHERE p.id = :id
        LIMIT 1
    ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @return array|false
     */
    public static function create(array $data)
    {
        $db = self::db();
        $estado = self::normalizeEstado($data['estado'] ?? null);

        $stmt = $db->prepare("
        INSERT INTO programas
            (titulo, descripcion_corta, contenido_detallado, duracion, modalidad,
             estado, destacado, orden_inicio)
        VALUES
            (:titulo, :descripcion_corta, :contenido_detallado, :duracion, :modalidad,
             :estado, :destacado, :orden_inicio)
    ");

        $result = $stmt->execute([
            'titulo' => $data['titulo'] ?? null,
            'descripcion_corta' => $data['descripcion_corta'] ?? null,
            'contenido_detallado' => $data['contenido_detallado'] ?? null,
            'duracion' => $data['duracion'] ?? null,
            'modalidad' => $data['modalidad'] ?? null,
            'estado' => $estado,
            'destacado' => isset($data['destacado']) ? 1 : 0,
            'orden_inicio' => (int) ($data['orden_inicio'] ?? 0),
        ]);

        if (!$result)
            return false;

        $id = $db->lastInsertId();

        if (!empty($data['imagen_principal'])) {
            self::registrarImagenPrincipal((int) $id, $data['imagen_principal']);
        }

        return self::find($id);
    }

    /* Actualizar */
    public static function update($id, array $data): bool
    {
        $db = self::db();
        $estado = self::normalizeEstado($data['estado'] ?? null);

        $stmt = $db->prepare("
        UPDATE programas SET
            titulo               = :titulo,
            descripcion_corta    = :descripcion_corta,
            contenido_detallado  = :contenido_detallado,
            duracion             = :duracion,
            modalidad            = :modalidad,
            estado               = :estado,
            destacado            = :destacado,
            orden_inicio         = :orden_inicio
        WHERE id = :id
    ");

        $result = $stmt->execute([
            'id' => $id,
            'titulo' => $data['titulo'] ?? null,
            'descripcion_corta' => $data['descripcion_corta'] ?? null,
            'contenido_detallado' => $data['contenido_detallado'] ?? null,
            'duracion' => $data['duracion'] ?? null,
            'modalidad' => $data['modalidad'] ?? null,
            'estado' => $estado,
            'destacado' => isset($data['destacado']) ? 1 : 0,
            'orden_inicio' => (int) ($data['orden_inicio'] ?? 0),
        ]);

        if ($result && !empty($data['imagen_principal'])) {
            self::registrarImagenPrincipal((int) $id, $data['imagen_principal']);
        }

        return $result;
    }

    /* Borrar */
    public static function delete($id)
    {
        $stmt = self::db()->prepare("
            DELETE FROM programas 
            WHERE id = :id
        ");

        return $stmt->execute([
            'id' => $id
        ]);
    }

    /* Programas destacado */
    public static function getDestacados()
    {
        $sql = "
        SELECT p.*, f.ruta_archivo
        FROM programas p
        LEFT JOIN multimedia_fotos f
            ON p.id = f.programa_id
            AND f.es_principal = 1
        WHERE p.estado = 'activo'
        AND p.destacado = 1
        ORDER BY p.orden_inicio ASC
    ";

        $stmt = self::db()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* Registra o reemplaza la imagen principal en multimedia_fotos */
    private static function registrarImagenPrincipal(int $programaId, string $ruta): void
    {
        $db = self::db();

        $db->prepare("
        UPDATE multimedia_fotos SET es_principal = 0 WHERE programa_id = :pid
    ")->execute(['pid' => $programaId]);

        $stmt = $db->prepare("
        SELECT id FROM multimedia_fotos WHERE programa_id = :pid AND ruta_archivo = :ruta LIMIT 1
    ");
        $stmt->execute(['pid' => $programaId, 'ruta' => $ruta]);
        $existe = $stmt->fetch();

        if ($existe) {
            $db->prepare("
            UPDATE multimedia_fotos SET es_principal = 1 WHERE id = :id
        ")->execute(['id' => $existe['id']]);
        } else {
            $db->prepare("
            INSERT INTO multimedia_fotos (programa_id, ruta_archivo, nombre_original, es_principal)
            VALUES (:pid, :ruta, :nombre, 1)
        ")->execute([
                        'pid' => $programaId,
                        'ruta' => $ruta,
                        'nombre' => basename($ruta),
                    ]);
        }
    }

    /* Todos los programas activos para la página pública */
    public static function getAllActivos(): array
    {
        $stmt = self::db()->prepare("
        SELECT p.*,
               (SELECT mf.ruta_archivo
                FROM multimedia_fotos mf
                WHERE mf.programa_id = p.id AND mf.es_principal = 1
                LIMIT 1) AS ruta_archivo
        FROM programas p
        WHERE p.estado = 'activo'
        ORDER BY p.orden_inicio ASC, p.fecha_creacion DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}