<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Programa</title>

    <link rel="stylesheet" href="../../css/normalize.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            background: #f4f6fb;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        }

        .app-card {
            border: 0;
            border-radius: 16px;
            overflow: hidden;
            background: #fff;
        }

        .soft-header {
            background: linear-gradient(135deg, #111827, #1f2937);
            color: #fff;
            padding: 18px 22px;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.15);
        }

        .section-title {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: .08em;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .floating-badge {
            background: #eef2ff;
            color: #4338ca;
            font-weight: 600;
            border-radius: 999px;
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        .card-footer {
            background: #fff;
            border-top: 1px solid #eef0f3;
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">

                <!-- CARD -->
                <form class="app-card shadow-sm">

                    <!-- HEADER CARD -->
                    <div class="soft-header">
                        <i class="bi bi-info-circle me-2"></i>
                        Información del programa
                    </div>

                    <div class="p-4">

                        <div class="section-title">Datos principales</div>

                        <!-- TITULO -->
                        <div class="mb-3">
                            <label class="form-label">Título del programa</label>
                            <input type="text" name="titulo" class="form-control form-control-lg"
                                placeholder="Ej: Diplomado en Marketing Digital"
                                value="<?= $programa['titulo'] ?? '' ?>" required>
                        </div>

                        <!-- DESCRIPCIÓN -->
                        <div class="mb-3">
                            <label class="form-label">Descripción corta</label>
                            <textarea name="descripcion_corta" class="form-control" rows="3"
                                placeholder="Resumen breve..."><?= $programa['descripcion_corta'] ?? '' ?></textarea>
                        </div>

                        <!-- CONTENIDO -->
                        <div class="mb-4">
                            <label class="form-label">Contenido detallado</label>
                            <textarea name="contenido_detallado" class="form-control" rows="6"
                                placeholder="Contenido completo..."><?= $programa['contenido_detallado'] ?? '' ?></textarea>
                        </div>

                        <hr class="my-4">

                        <div class="section-title">Configuración</div>

                        <div class="row g-3">

                            <!-- DURACIÓN -->
                            <div class="col-md-6">
                                <label class="form-label">Duración</label>
                                <input type="text" name="duracion" class="form-control" placeholder="Ej: 3 meses"
                                    value="<?= $programa['duracion'] ?? '' ?>">
                            </div>

                            <!-- MODALIDAD -->
                            <div class="col-md-6">
                                <label class="form-label">Modalidad</label>
                                <select name="modalidad" class="form-select">
                                    <option value="">Seleccione</option>
                                    <option value="Presencial" <?= (($programa['modalidad'] ?? '') === 'Presencial') ? 'selected' : '' ?>>Presencial</option>
                                    <option value="Virtual" <?= (($programa['modalidad'] ?? '') === 'Virtual') ? 'selected' : '' ?>>Virtual</option>
                                    <option value="Híbrido" <?= (($programa['modalidad'] ?? '') === 'Híbrido') ? 'selected' : '' ?>>Híbrido</option>
                                </select>
                            </div>

                            <!-- ESTADO -->
                            <div class="col-md-6">
                                <label class="form-label">Estado</label>
                                <select name="estado" class="form-select">
                                    <option value="activo" <?= (($programa['estado'] ?? '') === 'activo') ? 'selected' : '' ?>>Activo</option>
                                    <option value="inactivo" <?= (($programa['estado'] ?? '') === 'inactivo') ? 'selected' : '' ?>>Inactivo</option>
                                    <option value="borrador" <?= (($programa['estado'] ?? 'borrador') === 'borrador') ? 'selected' : '' ?>>Borrador</option>
                                </select>
                            </div>

                        </div>

                        <hr class="my-4">

                        <!-- SWITCH DESTACADO -->
                        <div class="d-flex align-items-center justify-content-between p-3 rounded-3 border bg-light">

                            <div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="destacado" id="destacado"
                                        value="1" <?= !empty($programa['destacado']) ? 'checked' : '' ?>>

                                    <label class="form-check-label fw-semibold" for="destacado">
                                        Mostrar en página principal
                                    </label>
                                </div>

                                <small class="text-muted">
                                    Este programa aparecerá destacado en el inicio.
                                </small>
                            </div>

                            <i class="bi bi-star text-warning fs-4"></i>

                        </div>

                        <!-- ORDEN -->
                        <div class="mt-4">
                            <label class="form-label">Orden en portada</label>
                            <input type="number" name="orden_inicio" class="form-control" style="max-width: 140px;"
                                min="0" value="<?= (int) ($programa['orden_inicio'] ?? 0) ?>">

                            <small class="text-muted">
                                Menor número = mayor prioridad
                            </small>
                        </div>

                    </div>



                </form>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>