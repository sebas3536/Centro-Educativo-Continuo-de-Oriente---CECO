<?php
require_once __DIR__ . '/../../../app/Middleware/RoleMiddleware.php';
require_once __DIR__ . '/../../../app/Models/Dashboard.php';
require_once __DIR__ . '/../../../app/Models/Programa.php';

RoleMiddleware::requireAdmin();


$stats = Dashboard::getEstadisticas();
$programas = Programa::getall();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — CECO Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/admin.css">
</head>

<body class="d-flex min-vh-100">

    <?php require __DIR__ . '/partials/sidebar.php'; ?>

    <main class="admin-main" id="adminMain">

        <!-- Topbar -->
        <div class="admin-topbar d-flex align-items-center gap-3 border-bottom mb-4 sticky-top">
            <button class="btn-hamburger btn p-0 d-lg-none" id="hamburgerBtn" aria-label="Abrir menú">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="topbar-title mb-0 fw-semibold">Dashboard</h1>
            <span class="topbar-date ms-auto text-muted small">
                <?= date('d M Y') ?>
            </span>
        </div>

        <!-- Métricas -->
        <section class="row g-3">

            <!-- Programas totales -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card p-3 d-flex flex-row align-items-center gap-3 h-100">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded stat-icon--blue"
                        style="width:48px;height:48px;font-size:1.4rem;">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small">Programas totales</span>
                        <span class="fs-4 fw-bold d-block"><?= $stats['programas']['total'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Activos -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card p-3 d-flex flex-row align-items-center gap-3 h-100">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded stat-icon--green"
                        style="width:48px;height:48px;font-size:1.4rem;">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small">Activos</span>
                        <span class="fs-4 fw-bold d-block"><?= $stats['programas']['activo'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Borradores -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card p-3 d-flex flex-row align-items-center gap-3 h-100">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded stat-icon--amber"
                        style="width:48px;height:48px;font-size:1.4rem;">
                        <i class="bi bi-pencil-fill"></i>
                    </div>
                    <div>
                        <span class="text-muted small">Borradores</span>
                        <span class="fs-4 fw-bold d-block"><?= $stats['programas']['borrador'] ?></span>
                    </div>
                </div>
            </div>

            <!-- Multimedia -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card p-3 d-flex flex-row align-items-center gap-3 h-100">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded stat-icon--purple"
                        style="width:48px;height:48px;font-size:1.4rem;">
                        <i class="bi bi-images"></i>
                    </div>
                    <div>
                        <span class="text-muted small">Fotos subidas</span>
                        <span class="fs-4 fw-bold d-block"><?= $stats['multimedia']['total'] ?></span>
                        <span class="text-muted small"><?= $stats['multimedia']['peso_total'] ?></span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Acciones rápidas -->
        <section class="quick-actions mt-4">

            <h2 class="fw-semibold text-secondary mb-3">
                Acciones rápidas
            </h2>

            <div class="row g-3">

                <div class="col-6 col-md-4">
                    <a href="?page=admin_programas&action=nuevo"
                        class="card text-decoration-none text-primary p-3 d-flex flex-column align-items-center gap-2 text-center h-100 action-card">
                        <i class="bi bi-plus-circle fs-3"></i>
                        <span>Nuevo programa</span>
                    </a>
                </div>

                <div class="col-6 col-md-4">
                    <a href="?page=multimedia&action=subir"
                        class="card text-decoration-none text-primary p-3 d-flex flex-column align-items-center gap-2 text-center h-100 action-card">
                        <i class="bi bi-cloud-upload fs-3"></i>
                        <span>Subir foto</span>
                    </a>
                </div>

                <div class="col-6 col-md-4">
                    <a href="?page=usuarios"
                        class="card text-decoration-none text-primary p-3 d-flex flex-column align-items-center gap-2 text-center h-100 action-card">
                        <i class="bi bi-person-plus fs-3"></i>
                        <span>Gestionar usuarios</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- Últimos programas -->
        <section class="mt-4">
            <h2 class="fw-semibold text-secondary mb-3">Últimos programas</h2>
            <div class="row g-4 mt-1">
                <?php if (!empty($programas)): ?>
                    <?php foreach ($programas as $programa): ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div>
                                            <h5 class="fw-bold mb-1">
                                                <?= htmlspecialchars($programa['titulo']) ?>
                                            </h5>
                                            <?php if ($programa['estado'] === 'activo'): ?>
                                                <span class="badge bg-success">Activo</span>
                                            <?php elseif ($programa['estado'] === 'inactivo'): ?>
                                                <span class="badge bg-danger">Inactivo</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Borrador</span>
                                            <?php endif; ?>
                                        </div>

                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm">⋮</button>
                                        </div>

                                    </div>

                                    <p class="text-muted">
                                        <?= htmlspecialchars($programa['descripcion_corta']) ?>
                                    </p>

                                    <div class="row text-center mt-4">
                                        <div class="col-6">
                                            <small class="text-muted d-block">Duración</small>
                                            <strong><?= htmlspecialchars($programa['duracion']) ?></strong>
                                        </div>

                                        <div class="col-6">
                                            <small class="text-muted d-block">Modalidad</small>
                                            <strong><?= htmlspecialchars($programa['modalidad']) ?></strong>
                                        </div>
                                    </div>

                                </div>

                                <div class="card-footer bg-transparent">
                                    <a href="#" class="btn btn-outline-primary w-100">
                                        Ver programa
                                    </a>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            No hay programas registrados aún.
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </section>

    </main>


    <div class="sidebar-overlay position-fixed top-0 start-0 w-100 h-100" id="sidebarOverlay"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php require __DIR__ . '/partials/sidebar_script.php'; ?>
</body>

</html>