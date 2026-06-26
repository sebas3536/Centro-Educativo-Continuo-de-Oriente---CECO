<?php

require_once __DIR__ . '/../Models/Programa.php';

class HomeController
{
    public function index(): void
    {
        $todos = Programa::getDestacados();
        $programasDestacados = array_slice($todos, 0, 4);

        $programasSlider = array_filter(
            $todos,
            fn($p) => !empty($p['ruta_archivo'])
        );
        $programasSlider = array_slice(array_values($programasSlider), 0, 5);

        require __DIR__ . '/../../resources/views/frontend/home.php';
    }

    public function todos(): void
    {
        $programas = Programa::getAllActivos();
        require __DIR__ . '/../../resources/views/frontend/programas.php';
    }
}