<?php

require_once __DIR__ . '/../../../app/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/../../../app/Middleware/RoleMiddleware.php';

AuthMiddleware::check();
RoleMiddleware::requireEditor();

echo "Bienvenido Editor: " . $_SESSION['user']['nombre'];
//echo '<a href="../../../index.php">Cerrar sesión</a>';
echo '<a href="/public/index.php?page=logout">Cerrar sesión</a>';