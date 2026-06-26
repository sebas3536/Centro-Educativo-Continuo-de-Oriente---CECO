<?php

require_once __DIR__ . '/../Models/Multimedia.php';
require_once __DIR__ . '/../Services/ImageService.php';

class MultimediaController
{
    public static function index(int $programaId): array
    {
        return MultimediaFoto::byPrograma($programaId);
    }

    public static function store(array $post, array $file): bool
    {
        $service = new ImageService();

        try {
            $rutaRelativa = $service->upload($file, 'uploads');
        } catch (Exception $e) {
            throw $e;
        }

        $data = [
            'programa_id' => $post['programa_id'] ?? null,
            'ruta_archivo' => $rutaRelativa,
            'nombre_original' => $file['name'],
            'peso_bytes' => $file['size'],
            'orden' => (int) ($post['orden'] ?? 0),
            'es_principal' => isset($post['es_principal']) ? 1 : 0,
        ];

        return MultimediaFoto::create($data);
    }

    public static function update(int $id, array $post, ?array $file = null): bool
    {
        $foto = MultimediaFoto::find($id);
        if (!$foto) {
            throw new Exception('Imagen no encontrada.');
        }

        $service = new ImageService();
        $rutaRelativa = $foto['ruta_archivo'];


        if (!empty($file['tmp_name'])) {
            $rutaRelativa = $service->upload($file, 'uploads');
            $service->delete($foto['ruta_archivo']);
        }

        $data = [
            'programa_id' => $post['programa_id'] ?? $foto['programa_id'],
            'ruta_archivo' => $rutaRelativa,
            'nombre_original' => !empty($file['name']) ? $file['name'] : $foto['nombre_original'],
            'peso_bytes' => !empty($file['size']) ? $file['size'] : $foto['peso_bytes'],
            'orden' => (int) ($post['orden'] ?? $foto['orden']),
            'es_principal' => isset($post['es_principal']) ? 1 : 0,
        ];

        return MultimediaFoto::update($id, $data);
    }

    public static function destroy(int $id): bool
    {
        $foto = MultimediaFoto::find($id);
        if (!$foto)
            return false;

        $service = new ImageService();
        $service->delete($foto['ruta_archivo']);

        return MultimediaFoto::delete($id);
    }
}