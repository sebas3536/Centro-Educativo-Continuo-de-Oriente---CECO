<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas — CECO</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">
</head>

<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="/index.php">
                    <img src="/img/logo.png" alt="Logo CECO" style="max-height:40px; width:auto;" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ms-auto">
                        <a class="nav-link" href="/index.php">Inicio</a>
                        <a class="nav-link" href="#">Institución</a>
                        <a class="nav-link active" href="?page=programas">Técnico Laboral</a>
                        <a class="nav-link active" href="?page=programas">Cursos</a>
                        <a class="nav-link" href="#">Noticias</a>
                        <a class="nav-link" href="#">Contáctenos</a>
                        <a class="ms-lg-3 btn btn-contacto align-self-center" href="/index.php?page=login">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero interno -->
    <section class="programas-hero d-flex align-items-end">
        <div class="container pb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/index.php" class="text-white text-decoration-none opacity-75">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active text-white">Programas</li>
                </ol>
            </nav>
            <h1 class="programas-hero__title">Todos nuestros programas</h1>
            <p class="programas-hero__sub">
                Encuentra el programa que impulse tu carrera profesional
            </p>
        </div>
    </section>

    <!-- Barra de filtro -->
    <div class="programas-filtro sticky-top">
        <div class="container d-flex align-items-center gap-3 flex-wrap py-2">
            <span class="text-muted small fw-semibold">
                <i class="bi bi-funnel me-1"></i>Modalidad:
            </span>
            <button class="filtro-btn active" data-filtro="todos">Todos</button>
            <button class="filtro-btn" data-filtro="Presencial">Presencial</button>
            <button class="filtro-btn" data-filtro="Virtual">Virtual</button>
            <button class="filtro-btn" data-filtro="Híbrido">Híbrido</button>
            <span class="ms-auto text-muted small" id="contadorProgramas">
                <?= count($programas) ?> programa(s)
            </span>
        </div>
    </div>

    <!-- Grid de programas -->
    <main class="container py-5">

        <?php if (empty($programas)): ?>
            <div class="text-center py-5 text-muted">
                <i class="bi bi-journal-x fs-1 d-block mb-3"></i>
                No hay programas disponibles en este momento.
            </div>
        <?php else: ?>

            <div class="row g-4" id="gridProgramas">
                <?php foreach ($programas as $programa): ?>

                    <div class="col-12 col-sm-6 col-lg-4 programa-item"
                        data-modalidad="<?= htmlspecialchars($programa['modalidad'] ?? '') ?>">

                        <div class="card programa-publica-card h-100">

                            <!-- Imagen -->
                            <div class="programa-publica-card__img">
                                <?php if (!empty($programa['ruta_archivo'])): ?>
                                    <img src="/<?= htmlspecialchars($programa['ruta_archivo']) ?>"
                                        alt="<?= htmlspecialchars($programa['titulo']) ?>">
                                <?php else: ?>
                                    <div class="programa-publica-card__placeholder">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($programa['modalidad'])): ?>
                                    <span class="programa-publica-card__modalidad">
                                        <?= htmlspecialchars($programa['modalidad']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Cuerpo -->
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="programa-publica-card__title">
                                    <?= htmlspecialchars($programa['titulo']) ?>
                                </h3>
                                <p class="programa-publica-card__desc text-muted">
                                    <?= htmlspecialchars($programa['descripcion_corta'] ?? '') ?>
                                </p>

                                <div class="programa-publica-card__meta mt-auto mb-3">
                                    <?php if (!empty($programa['duracion'])): ?>
                                        <span>
                                            <i class="bi bi-clock me-1"></i>
                                            <?= htmlspecialchars($programa['duracion']) ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($programa['modalidad'])): ?>
                                        <span>
                                            <i class="bi bi-laptop me-1"></i>
                                            <?= htmlspecialchars($programa['modalidad']) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <a href="?page=programa&id=<?= $programa['id'] ?>"
                                    class="btn btn-primary w-100 rounded-pill fw-semibold">
                                    Ver programa
                                </a>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>
            </div>

            <!-- Mensaje sin resultados del filtro -->
            <div class="text-center py-5 text-muted d-none" id="sinResultados">
                <i class="bi bi-search fs-1 d-block mb-3"></i>
                No hay programas con esta modalidad.
            </div>

        <?php endif; ?>

    </main>

    <!-- Footer -->
    <footer class="bg-white border-top py-4">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-1" style="color:var(--blue-main);">
                        CECO - Centro de Educación Continua de Oriente
                    </h6>
                    <p class="text-muted mb-0">Calle 23 No 26-128, Soledad - Atlántico</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <nav class="nav justify-content-center">
                        <a href="#" class="nav-link px-2 text-secondary small">Nosotros</a>
                        <a href="#" class="nav-link px-2 text-secondary small">Políticas</a>
                        <a href="#" class="nav-link px-2 text-secondary small">Términos</a>
                    </nav>
                </div>
                <div class="col-md-3 text-center text-md-end">
                    <small class="text-muted">© 2026 CECO</small>
                </div>
            </div>
            <hr class="my-3">
            <div class="text-center">
                <small class="text-muted">Todos los derechos reservados.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true });

        // Scroll navbar
        window.addEventListener('scroll', function () {
            document.querySelector('.navbar-custom')
                .classList.toggle('scrolled', window.scrollY > 50);
        });

        // Filtro por modalidad
        const btnsFiltro = document.querySelectorAll('.filtro-btn');
        const items = document.querySelectorAll('.programa-item');
        const contador = document.getElementById('contadorProgramas');
        const sinResultados = document.getElementById('sinResultados');
        const grid = document.getElementById('gridProgramas');

        btnsFiltro.forEach(function (btn) {
            btn.addEventListener('click', function () {
                btnsFiltro.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filtro = btn.dataset.filtro;
                let visibles = 0;

                items.forEach(function (item) {
                    const modalidad = item.dataset.modalidad;
                    const mostrar = filtro === 'todos' || modalidad === filtro;
                    item.style.display = mostrar ? '' : 'none';
                    if (mostrar) visibles++;
                });

                contador.textContent = visibles + ' programa(s)';
                sinResultados.classList.toggle('d-none', visibles > 0);
                grid.classList.toggle('d-none', visibles === 0);
            });
        });
    </script>

</body>

</html>