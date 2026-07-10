<?php
require_once __DIR__ . '/../../../app/Controllers/MultimediaController.php';
require_once __DIR__ . '/../../../app/Models/Programa.php';

$programaId = (int)($_GET['programa_id'] ?? 0);
$fotos      = $programaId ? MultimediaController::index($programaId) : [];
$programas  = Programa::getAll();
$error      = $_SESSION['multimedia_error'] ?? null;
$success    = $_SESSION['multimedia_ok']    ?? null;
unset($_SESSION['multimedia_error'], $_SESSION['multimedia_ok']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Imágenes — CECO</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="programa-body">

<?php require __DIR__ . '/partials/sidebar.php'; ?>

<main class="programa-main" id="programaMain">

    <!-- Topbar -->
    <div class="admin-topbar d-flex align-items-center gap-2 px-1 border-bottom mb-4">
        <button class="btn-hamburger d-lg-none border-0 bg-transparent" id="hamburgerBtn">
            <i class="bi bi-list fs-4"></i>
        </button>
        <h1 class="topbar-title mb-0">Gestión de Imágenes</h1>
        <span class="topbar-date text-muted small ms-auto"><?= date('d M Y') ?></span>
    </div>

    <div class="container-fluid px-3 px-lg-4">

        <!-- Alertas -->
        <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <?= htmlspecialchars($error) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle-fill me-2"></i>
                <?= htmlspecialchars($success) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Selector de programa -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header-form">
                <i class="bi bi-collection me-2"></i>Selecciona un programa
            </div>
            <div class="card-body">
                <form method="GET">
                    <input type="hidden" name="page" value="admin_multimedia">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-8 col-lg-6">
                            <label class="form-label fw-semibold small text-muted">Programa</label>
                            <select name="programa_id" class="form-select"
                                    onchange="this.form.submit()">
                                <option value="">— Elige un programa —</option>
                                <?php foreach ($programas as $p): ?>
                                    <option value="<?= $p['id'] ?>"
                                        <?= $p['id'] == $programaId ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($p['titulo']) ?>
                                        (<?= $p['estado'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($programaId): ?>

        <!-- Formulario subida -->
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header-form">
                <i class="bi bi-cloud-upload me-2"></i>Subir nueva imagen
            </div>
            <div class="card-body">
                <form method="POST"
                      action="?page=admin_multimedia&action=guardar&programa_id=<?= $programaId ?>"
                      enctype="multipart/form-data">
                    <input type="hidden" name="programa_id" value="<?= $programaId ?>">

                    <div class="row g-3 align-items-end">

                        <!-- Input archivo -->
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-semibold small text-muted">
                                Imagen
                                <span class="fw-normal">(JPG, PNG, WEBP · máx. 2 MB)</span>
                            </label>
                            <input type="file" name="imagen" id="inputImagen"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,.webp" required>

                            <!-- Preview -->
                            <div class="mt-2 d-none" id="previewBox">
                                <img id="previewImg" src="" alt="Preview"
                                     class="rounded border"
                                     style="max-height:100px; max-width:100%; object-fit:cover;">
                                <small id="previewInfo" class="d-block text-muted mt-1"></small>
                            </div>
                        </div>

                        <!-- Orden -->
                        <div class="col-6 col-md-2">
                            <label class="form-label fw-semibold small text-muted">Orden</label>
                            <input type="number" name="orden"
                                   class="form-control" value="0" min="0">
                        </div>

                        <!-- Switch principal -->
                        <div class="col-6 col-md-3 d-flex align-items-center">
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox"
                                       name="es_principal" id="esPrincipal" value="1"
                                       role="switch">
                                <label class="form-check-label fw-semibold" for="esPrincipal">
                                    Principal
                                </label>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="col-12 col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-upload me-1"></i>Subir
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- Galería -->
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header-form d-flex justify-content-between align-items-center">
                <span><i class="bi bi-images me-2"></i>Imágenes del programa</span>
                <span class="badge bg-secondary rounded-pill"><?= count($fotos) ?></span>
            </div>
            <div class="card-body p-3 p-md-4">

                <?php if (empty($fotos)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-image fs-1 d-block mb-2 opacity-50"></i>
                        <p class="mb-0">Este programa aún no tiene imágenes.</p>
                    </div>
                <?php else: ?>

                    <div class="row g-3">
                        <?php foreach ($fotos as $foto): ?>
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="media-card <?= $foto['es_principal'] ? 'media-card--principal' : '' ?>">

                                    <!-- Imagen -->
                                    <div class="media-card__img">
                                        <img src="<?= BASE_URL . htmlspecialchars($foto['ruta_archivo']) ?>"
                                             alt="<?= htmlspecialchars($foto['nombre_original'] ?? '') ?>">

                                        <?php if ($foto['es_principal']): ?>
                                            <span class="media-card__star">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Info -->
                                    <div class="media-card__body">
                                        <p class="media-card__name text-truncate mb-1"
                                           title="<?= htmlspecialchars($foto['nombre_original'] ?? '') ?>">
                                            <?= htmlspecialchars($foto['nombre_original'] ?? 'Sin nombre') ?>
                                        </p>
                                        <p class="media-card__meta mb-2">
                                            Orden <?= $foto['orden'] ?>
                                            <?php if ($foto['peso_bytes']): ?>
                                                · <?= round($foto['peso_bytes'] / 1024) ?> KB
                                            <?php endif; ?>
                                        </p>

                                        <!-- Acciones -->
                                        <div class="d-flex gap-1">
                                            <button class="btn btn-outline-primary btn-sm flex-grow-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditar"
                                                    data-id="<?= $foto['id'] ?>"
                                                    data-orden="<?= $foto['orden'] ?>"
                                                    data-principal="<?= $foto['es_principal'] ?>"
                                                    data-src="<?= BASE_URL . htmlspecialchars($foto['ruta_archivo']) ?>"
                                                    title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </button>

                                            <form method="POST"
                                                  action="?page=admin_multimedia&action=eliminar&programa_id=<?= $programaId ?>"
                                                  onsubmit="return confirm('¿Eliminar esta imagen? No se puede deshacer.')">
                                                <input type="hidden" name="id" value="<?= $foto['id'] ?>">
                                                <input type="hidden" name="programa_id" value="<?= $programaId ?>">
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

        <?php endif; ?>

    </div>
</main>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" enctype="multipart/form-data"
              action="?page=admin_multimedia&action=actualizar&programa_id=<?= $programaId ?>">
            <div class="modal-content rounded-4 border-0 shadow">

                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="modalEditarLabel">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>Editar imagen
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body pt-3">
                    <input type="hidden" name="id" id="editId">
                    <input type="hidden" name="programa_id" value="<?= $programaId ?>">

                    <!-- Preview actual -->
                    <div class="text-center mb-3">
                        <img id="editPreview" src="" alt="Imagen actual"
                             class="rounded-3 border"
                             style="max-height:160px; max-width:100%; object-fit:cover;">
                        <p class="small text-muted mt-1 mb-0">Imagen actual</p>
                    </div>

                    <!-- Reemplazar imagen -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">
                            Reemplazar imagen
                            <span class="fw-normal">(opcional · JPG, PNG, WEBP · máx. 2 MB)</span>
                        </label>
                        <input type="file" name="imagen" id="editFileInput"
                               class="form-control"
                               accept=".jpg,.jpeg,.png,.webp">
                        <div class="mt-2 d-none" id="editPreviewNewBox">
                            <img id="editPreviewNew" src="" alt="Nueva"
                                 class="rounded border"
                                 style="max-height:90px; object-fit:cover;">
                            <small class="d-block text-muted mt-1">Nueva imagen seleccionada</small>
                        </div>
                    </div>

                    <!-- Orden -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-muted">Orden</label>
                        <input type="number" name="orden" id="editOrden"
                               class="form-control" min="0"
                               style="max-width:100px;">
                    </div>

                    <!-- Switch principal -->
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox"
                               name="es_principal" id="editEsPrincipal"
                               value="1" role="switch">
                        <label class="form-check-label fw-semibold" for="editEsPrincipal">
                            Imagen principal del programa
                        </label>
                    </div>
                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bi bi-save me-1"></i>Guardar cambios
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<?php require __DIR__ . '/partials/sidebar_script.php'; ?>

<script>
// Preview subida nueva
document.getElementById('inputImagen')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    if (!['image/jpeg','image/png','image/webp'].includes(file.type)) {
        alert('Solo JPG, PNG o WEBP.');
        this.value = ''; return;
    }
    if (file.size > 2 * 1024 * 1024) {
        alert('El archivo supera los 2 MB.');
        this.value = ''; return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('previewImg').src = e.target.result;
        document.getElementById('previewInfo').textContent =
            `${file.name} · ${(file.size/1024).toFixed(0)} KB`;
        document.getElementById('previewBox').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
});

// Poblar modal editar
document.getElementById('modalEditar')?.addEventListener('show.bs.modal', function (e) {
    const btn = e.relatedTarget;
    document.getElementById('editId').value              = btn.dataset.id;
    document.getElementById('editOrden').value           = btn.dataset.orden;
    document.getElementById('editEsPrincipal').checked   = btn.dataset.principal === '1';
    document.getElementById('editPreview').src           = btn.dataset.src;
    document.getElementById('editFileInput').value       = '';
    document.getElementById('editPreviewNewBox').classList.add('d-none');
});

// Preview en modal editar
document.getElementById('editFileInput')?.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;

    if (!['image/jpeg','image/png','image/webp'].includes(file.type)) {
        alert('Solo JPG, PNG o WEBP.');
        this.value = ''; return;
    }
    if (file.size > 2 * 1024 * 1024) {
        alert('El archivo supera los 2 MB.');
        this.value = ''; return;
    }

    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('editPreviewNew').src = e.target.result;
        document.getElementById('editPreviewNewBox').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
});
</script>

</body>
</html>