<?php
require_once __DIR__ . '/../../../../app/Middleware/RoleMiddleware.php';
RoleMiddleware::requireAdmin();
$programa = [];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Programa — CECO Admin</title>
    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body class="programa-body">

    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="programa-main" id="programaMain">
        <div class="admin-topbar">
            <button class="btn-hamburger d-lg-none" id="hamburgerBtn">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="topbar-title">Nuevo Programa</h1>
            <span class="topbar-date text-muted small"><?= date('d M Y') ?></span>
        </div>

        <div class="container py-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-1">
                        <i class="bi bi-plus-circle me-2 text-primary"></i>Nuevo Programa
                    </h2>
                    <p class="text-muted mb-0">Completa la información del nuevo programa académico</p>
                </div>
                <a href="?page=admin_programas" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left me-1"></i>Volver
                </a>
            </div>

            <form action="?page=admin_programas&action=guardar" method="POST" enctype="multipart/form-data">
                <div class="row g-4">

                    <!-- Columna izquierda: datos -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                            <div class="card-header-form">
                                <i class="bi bi-info-circle me-2"></i>Información del programa
                            </div>
                            <div class="card-body p-4">
                                <?php require __DIR__ . '/partials/form.php'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Columna derecha: imagen + acciones -->
                    <div class="col-lg-4">

                        <!-- Imagen principal -->
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-3">
                            <div class="card-header-form">
                                <i class="bi bi-image me-2"></i>Imagen principal
                            </div>
                            <div class="card-body p-3">
                                <?php require __DIR__ . '/partials/image_upload.php'; ?>
                            </div>
                        </div>

                        <!-- Acciones -->
                        <div class="card border-0 shadow-sm rounded-4">
                            <div class="card-body p-3 d-flex flex-column gap-2">
                                <button type="submit" class="btn btn-primary w-100 shadow-sm">
                                    <i class="bi bi-check2-circle me-2"></i>Guardar programa
                                </button>
                                <a href="?page=admin_programas" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-x-circle me-1"></i>Cancelar
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </main>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>