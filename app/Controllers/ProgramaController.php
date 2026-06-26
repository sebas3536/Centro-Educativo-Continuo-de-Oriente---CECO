<?php
require_once __DIR__ . '/../Models/Programa.php';
require_once __DIR__ . '/../Services/ImageService.php';

class ProgramaController
{
    public function index(): void
    {
        $programas = Programa::getAll();
        require __DIR__ . '/../../resources/views/admin/programas/programas.php';
    }

    public function create(): void
    {
        $programa = [];
        require __DIR__ . '/../../resources/views/admin/programas/create.php';
    }

    public function store(array $post, array $files = []): void
    {

        if (!empty($files['imagen_principal']['tmp_name'])) {
            try {
                $service = new ImageService();
                $post['imagen_principal'] = $service->upload($files['imagen_principal'], 'uploads/programas');
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header('Location: ?page=admin_programas&action=nuevo');
                exit;
            }
        }

        Programa::create($post);
        header('Location: ?page=admin_programas');
        exit;
    }

    public function edit(int $id): void
    {
        $programa = Programa::find($id);
        if (!$programa) {
            header('Location: ?page=admin_programas');
            exit;
        }
        require __DIR__ . '/../../resources/views/admin/programas/edit.php';
    }

    public function update(int $id, array $post, array $files = []): void
    {
        $programa = Programa::find($id);
        if (!$programa) {
            header('Location: ?page=admin_programas');
            exit;
        }

        if (!empty($files['imagen_principal']['tmp_name'])) {
            try {
                $service = new ImageService();

                if (!empty($programa['imagen_principal'])) {
                    $service->delete($programa['imagen_principal']);
                }

                $post['imagen_principal'] = $service->upload($files['imagen_principal'], 'uploads/programas');
            } catch (Exception $e) {
                $_SESSION['error'] = $e->getMessage();
                header("Location: ?page=admin_programas&action=editar&id={$id}");
                exit;
            }
        } else {
            $post['imagen_principal'] = $programa['imagen_principal'];
        }

        Programa::update($id, $post);
        header('Location: ?page=admin_programas');
        exit;
    }

    public function delete(int $id): void
    {
        $programa = Programa::find($id);

        if ($programa && !empty($programa['imagen_principal'])) {
            (new ImageService())->delete($programa['imagen_principal']);
        }

        Programa::delete($id);
        header('Location: ?page=admin_programas');
        exit;
    }
}