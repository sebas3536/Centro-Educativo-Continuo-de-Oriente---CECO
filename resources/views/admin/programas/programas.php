<?php
require_once __DIR__ . '/../../../../app/Middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../../app/Models/Programa.php';

RoleMiddleware::requireAdmin();
$programas = Programa::getAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas — CECO Admin</title>

    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/admin.css">
</head>

<body class="d-flex min-vh-100 bg-light">

    <?php require __DIR__ . '/../partials/sidebar.php'; ?>

    <main class="programa-main" id="programaMain">

        <!-- TOPBAR -->
        <div class="bg-white border-bottom px-3 py-2 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-secondary d-lg-none" id="hamburgerBtn">
                    <i class="bi bi-list"></i>
                </button>

                <h1 class="h5 mb-0">Programas</h1>
            </div>

            <span class="text-muted small"><?= date('d M Y') ?></span>
        </div>

        <div class="container py-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">
                    <?= count($programas) ?> programa(s) registrado(s)
                </p>

                <a href="?page=admin_programas&action=nuevo" class="btn btn-primary">
                    <i class="bi bi-plus-lg me-1"></i> Nuevo programa
                </a>
            </div>

            <!-- GRID -->
            <div class="row g-4">

                <?php if (empty($programas)): ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No hay programas registrados aún.
                        </div>
                    </div>
                <?php endif; ?>

                <?php foreach ($programas as $programa): ?>
                    <div class="col-md-6 col-lg-4">

                        <div class="card border-0 shadow-sm h-100 prog-card">

                            <!-- IMAGEN -->
                            <div class="position-relative prog-card__img">

                                <?php if (!empty($programa['imagen_principal'])): ?>
                                    <img src="/<?= htmlspecialchars($programa['imagen_principal']) ?>"
                                        alt="<?= htmlspecialchars($programa['titulo']) ?>">
                                <?php else: ?>
                                    <div class="prog-card__img-placeholder">
                                        <i class="bi bi-image"></i>
                                    </div>
                                <?php endif; ?>

                                <!-- ESTADO -->
                                <span class="badge prog-card__badge prog-card__badge--<?= $programa['estado'] ?>">
                                    <?= ucfirst($programa['estado']) ?>
                                </span>

                                <!-- DESTACADO -->
                                <?php if (!empty($programa['destacado'])): ?>
                                    <span class="prog-card__featured">
                                        <i class="bi bi-star-fill"></i>
                                    </span>
                                <?php endif; ?>

                            </div>

                            <!-- BODY -->
                            <div class="card-body">

                                <h5 class="fw-bold mb-2">
                                    <?= htmlspecialchars($programa['titulo']) ?>
                                </h5>

                                <p class="text-muted small prog-card__desc mb-3">
                                    <?= htmlspecialchars($programa['descripcion_corta'] ?? '—') ?>
                                </p>

                                <div class="d-flex flex-wrap gap-2 small text-muted">

                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-clock me-1"></i>
                                        <?= htmlspecialchars($programa['duracion'] ?? '—') ?>
                                    </span>

                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-laptop me-1"></i>
                                        <?= htmlspecialchars($programa['modalidad'] ?? '—') ?>
                                    </span>

                                </div>
                            </div>

                            <!-- FOOTER -->
                            <div class="card-footer d-flex p-0 bg-white border-top">

                                <a href="?page=admin_multimedia&programa_id=<?= $programa['id'] ?>"
                                    class="btn btn-light w-100 rounded-0" title="Imágenes">
                                    <i class="bi bi-images"></i>
                                </a>

                                <a href="?page=admin_programas&action=editar&id=<?= $programa['id'] ?>"
                                    class="btn btn-warning w-100 rounded-0" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="?page=admin_programas&action=eliminar&id=<?= $programa['id'] ?>"
                                    class="btn btn-danger w-100 rounded-0" title="Eliminar"
                                    onclick="return confirm('¿Eliminar este programa?')">
                                    <i class="bi bi-trash"></i>
                                </a>

                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </main>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php require __DIR__ . '/../partials/sidebar_script.php'; ?>

</body>

</html>