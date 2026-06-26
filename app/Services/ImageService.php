<?php

class ImageService
{
    // Dimensiones máximas para la portada del sitio
    private const MAX_WIDTH = 800;
    private const MAX_HEIGHT = 600;
    private const MAX_BYTES = 2 * 1024 * 1024; // 2 MB
    private const ALLOWED = ['jpg', 'jpeg', 'png', 'webp'];

    public function upload(array $file, string $folder = 'uploads'): string
    {

        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Error al recibir el archivo (código ' . $file['error'] . ').');
        }


        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, self::ALLOWED, true)) {
            throw new Exception('Formato no permitido. Solo se aceptan: JPG, PNG, WEBP.');
        }


        if ($file['size'] > self::MAX_BYTES) {
            throw new Exception('El archivo supera el límite de 2 MB.');
        }


        $mime = mime_content_type($file['tmp_name']);
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($mime, $allowedMimes, true)) {
            throw new Exception('El archivo no es una imagen válida.');
        }


        $uploadDir = __DIR__ . '/../../storage/' . $folder;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }


        $fileName = uniqid('img_', true) . '.webp';
        $fullPath = $uploadDir . '/' . $fileName;


        $this->resizeAndSave($file['tmp_name'], $mime, $fullPath);


        return 'storage/' . $folder . '/' . $fileName;
    }


    public function delete(string $relativePath): void
    {
        $fullPath = __DIR__ . '/../../' . $relativePath;
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    private function resizeAndSave(string $tmpPath, string $mime, string $destPath): void
    {
        $source = match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($tmpPath),
            'image/png' => imagecreatefrompng($tmpPath),
            'image/webp' => imagecreatefromwebp($tmpPath),
            default => throw new Exception('Tipo MIME no soportado para procesamiento.')
        };

        [$origWidth, $origHeight] = getimagesize($tmpPath);

        [$newWidth, $newHeight] = $this->calculateDimensions(
            $origWidth,
            $origHeight,
            self::MAX_WIDTH,
            self::MAX_HEIGHT
        );

        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        if ($mime === 'image/png') {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);
        }

        imagecopyresampled(
            $canvas,
            $source,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );


        imagewebp($canvas, $destPath, 85);

        imagedestroy($source);
        imagedestroy($canvas);
    }

    private function calculateDimensions(
        int $origW,
        int $origH,
        int $maxW,
        int $maxH
    ): array {

        if ($origW <= $maxW && $origH <= $maxH) {
            return [$origW, $origH];
        }

        $ratio = min($maxW / $origW, $maxH / $origH);
        $newWidth = (int) round($origW * $ratio);
        $newHeight = (int) round($origH * $ratio);

        return [$newWidth, $newHeight];
    }
}