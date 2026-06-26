<?php

require_once __DIR__ . '/../../config/connection.php';

class MultimediaFoto
{
    private static function db()
    {
        return Database::getConnection();
    }

    /* Listar */
    public static function all()
    {
        $db = self::db();

        $stmt = $db->prepare("SELECT * FROM multimedia_fotos ORDER BY id DESC");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /* Obtener multimedia por programa */
    public static function find($id)
    {
        $db = self::db();

        $stmt = $db->prepare("SELECT * FROM multimedia_fotos WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch();
    }
    
    /* Crear */
    public static function create($data)
    {
        $db = self::db();

        if (!empty($data['es_principal'])) {
            $stmt = $db->prepare("UPDATE multimedia_fotos SET es_principal = 0 WHERE programa_id = :programa_id");
            $stmt->execute([
                'programa_id' => $data['programa_id']
            ]);
        }

        $sql = "INSERT INTO multimedia_fotos (programa_id, ruta_archivo, nombre_original, peso_bytes, orden, es_principal)VALUES (:programa_id, :ruta_archivo, :nombre_original, :peso_bytes, :orden, :es_principal)";
        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'programa_id' => $data['programa_id'] ?? null,
            'ruta_archivo' => $data['ruta_archivo'] ?? null,
            'nombre_original' => $data['nombre_original'] ?? null,
            'peso_bytes' => $data['peso_bytes'] ?? null,
            'orden' => $data['orden'] ?? 0,
            'es_principal' => $data['es_principal'] ?? 0,
        ]);
    }

    /* Actualizar */
    public static function update($id, $data)
    {
        $db = self::db();
        if (!empty($data['es_principal'])) {
            $stmt = $db->prepare("
        UPDATE multimedia_fotos 
        SET es_principal = 0 
        WHERE programa_id = :programa_id
        AND id != :id
    ");

            $stmt->execute([
                'programa_id' => $data['programa_id'],
                'id' => $id
            ]);
        }

        $sql = "UPDATE multimedia_fotos 
            SET programa_id = :programa_id,
                ruta_archivo = :ruta_archivo,
                nombre_original = :nombre_original,
                peso_bytes = :peso_bytes,
                orden = :orden,
                es_principal = :es_principal
            WHERE id = :id";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'programa_id' => $data['programa_id'] ?? null,
            'ruta_archivo' => $data['ruta_archivo'] ?? null,
            'nombre_original' => $data['nombre_original'] ?? null,
            'peso_bytes' => $data['peso_bytes'] ?? null,
            'orden' => $data['orden'] ?? 0,
            'es_principal' => $data['es_principal'] ?? 0,
        ]);
    }

    /* Borrar */
    public static function delete($id)
    {
        $db = self::db();

        $stmt = $db->prepare("DELETE FROM multimedia_fotos WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->rowCount() > 0;
    }

    /* Listar fotos de un programa específico */
    public static function byPrograma(int $programaId): array
    {
        $stmt = self::db()->prepare("
        SELECT * 
        FROM multimedia_fotos 
        WHERE programa_id = :programa_id 
        ORDER BY es_principal DESC, orden ASC, id DESC
    ");
        $stmt->execute(['programa_id' => $programaId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}