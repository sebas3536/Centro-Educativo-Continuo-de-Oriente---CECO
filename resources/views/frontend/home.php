<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Educativo Continuo de Oriente - CECO</title>
    <link rel="stylesheet" href="css/normalize.css">

    <!-- Bootstrap 5.3.2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

</head>

<body>
    <!-- Inicio Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-custom fixed-top ">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html">
                    <img src="img/logo.png" alt="Logo CECO" style="max-height: 40px; width: auto;" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto ">
                        <a class="nav-link active" aria-current="page" href="index.html">Inicio </a>
                        <a class="nav-link" href="#">Institucion</a>
                        <a class="nav-link" href="#">Tecnico Laboral</a>
                        <a class="nav-link" href="#">Cursos</a>
                        <a class="nav-link" href="#">Noticias</a>
                        <a class="nav-link" href="#">Contactenos</a>
                        <a class="ms-lg-3 btn btn-contacto align-self-center"
                            href="?page=login">Login</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Fin Header -->

        <!-- BANNER PUBLICITARIO DE ENTRADA -->
<div id="heroCarousel" class="carousel slide carousel-fade"
     data-bs-ride="carousel"
     data-bs-interval="5000">

    <div class="carousel-inner">

        <?php if (!empty($programasSlider)): ?>

            <?php foreach ($programasSlider as $indice => $slide): ?>
                <div class="carousel-item <?= $indice === 0 ? 'active' : '' ?> hero-slide">

                    <img
                        src="/<?= htmlspecialchars($slide['ruta_archivo']) ?>"
                        class="d-block w-100"
                        alt="<?= htmlspecialchars($slide['titulo']) ?>"
                    >

                    <div class="hero-content">
                        <h1><?= htmlspecialchars($slide['titulo']) ?></h1>

                        <?php if (!empty($slide['descripcion_corta'])): ?>
                            <p><?= htmlspecialchars($slide['descripcion_corta']) ?></p>
                        <?php endif; ?>

                        <div class="hero-buttons">
                            <a href="?page=programa&id=<?= $slide['id'] ?>"
                               class="btn btn-primary btn-lg">
                                Ver programa
                            </a>
                            <a href="#programas-section"
                               class="btn btn-outline-light btn-lg">
                                Ver todos
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

        <?php else: ?>

            <!-- Fallback estático si no hay programas destacados con imagen -->
            <div class="carousel-item active hero-slide">
                <img src="img/Mercadeo.png" class="d-block w-100" alt="CECO">
                <div class="hero-content">
                    <h1>Bienvenido a CECO</h1>
                    <p>Formamos profesionales con excelencia académica</p>
                    <div class="hero-buttons">
                        <a href="#programas-section" class="btn btn-primary btn-lg">
                            Ver programas
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </div>

    <!-- Controles — solo si hay más de 1 slide -->
    <?php if (count($programasSlider) > 1): ?>
        <button class="carousel-control-prev" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button"
                data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>

        <!-- Indicadores de posición -->
        <div class="carousel-indicators">
            <?php foreach ($programasSlider as $i => $_): ?>
                <button type="button"
                        data-bs-target="#heroCarousel"
                        data-bs-slide-to="<?= $i ?>"
                        <?= $i === 0 ? 'class="active" aria-current="true"' : '' ?>
                        aria-label="Slide <?= $i + 1 ?>">
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</div>
<!-- Fin BANNER PUBLICITARIO DE ENTRADA -->

    <!-- Eslogan Cohesivo -->
    <div class="eslogan-container" data-aos="fade-up">
        <p class="eslogan-text"><i class="bi bi-cursor-fill me-1"></i> "Estudiar con nosotros es estar a un click del
            éxito"</p>
    </div>
    <!-- Fin Eslogan Cohesivo -->

    <!-- Sección de Nuestra institucion -->
    <section class="institucion-section" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center py-5">

                <!-- Imagen -->
                <div class="col-lg-6 text-center order-1 order-lg-2">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Nuestra Institución" class="img-fluid rounded shadow w-100">
                </div>

                <!-- Contenido -->
                <div class="col-lg-6 order-2 order-lg-1">
                    <h2 class="text-primary fw-semibold text-uppercase mt-4 text-center text-lg-start">
                        Nuestra Institución
                    </h2>

                    <p class="display-6 fw-bold mt-2 mb-4 text-center text-lg-start">
                        Formando profesionales con excelencia académica
                    </p>

                    <p class="text-secondary">
                        Somos una entidad educativa comprometida con la formación integral
                        de nuestros estudiantes, promoviendo valores, innovación y excelencia
                        en cada proceso de aprendizaje.
                    </p>

                    <p class="text-secondary">
                        Con años de experiencia en el sector educativo, ofrecemos programas
                        académicos diseñados para responder a las necesidades actuales del
                        mercado laboral y contribuir al desarrollo personal y profesional
                        de nuestra comunidad.
                    </p>

                    <div class="mt-4 text-center text-lg-start">
                        <a href="#" class="btn btn-primary btn-lg px-5 py-3 shadow">
                            Conoce más
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Fin Sección de Nuestra institucion-->

    <!-- Menú de Accesos Rápidos (Grilla Fija de 8 Íconos 4x2) -->
    <div class="menu-circular-container" data-aos="fade-up">
        <div class="row row-cols-4 g-5">

            <!-- Ícono 1: Programas -->
            <div class="col">
                <a href="#programas-section" class="menu-circle-item ">
                    <div class="circle-icon-wrapper">
                        <!-- Descomentar cuando el diseñador envíe el activo: -->
                        <!-- <img src="assets/img/icon-programas.png" alt="Programas"> -->
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <span class="menu-circle-text">Programas</span>
                </a>
            </div>

            <!-- Ícono 2: Inscripciones -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-inscripciones.png" alt="Inscripciones"> -->
                        <i class="bi bi-file-earmark-text-fill"></i>
                    </div>
                    <span class="menu-circle-text">Inscripciones</span>
                </a>
            </div>

            <!-- Ícono 3: Testimonios -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-testimonios.png" alt="Testimonios"> -->
                        <i class="bi bi-chat-heart-fill"></i>
                    </div>
                    <span class="menu-circle-text">Testimonios</span>
                </a>
            </div>

            <!-- Ícono 4: Convenios -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-convenios.png" alt="Convenios"> -->
                        <i class="bi bi-person-check-fill"></i>
                    </div>
                    <span class="menu-circle-text">Convenios</span>
                </a>
            </div>

            <!-- Ícono 5: Aula Virtual -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-aula.png" alt="Aula Virtual"> -->
                        <i class="bi bi-laptop-fill"></i>
                    </div>
                    <span class="menu-circle-text">Aula Virtual</span>
                </a>
            </div>

            <!-- Ícono 6: Empleo -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-empleo.png" alt="Empleo"> -->
                        <i class="bi bi-briefcase-fill"></i>
                    </div>
                    <span class="menu-circle-text">Empleo</span>
                </a>
            </div>

            <!-- Ícono 7: Eventos -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-eventos.png" alt="Eventos"> -->
                        <i class="bi bi-calendar-event-fill"></i>
                    </div>
                    <span class="menu-circle-text">Eventos</span>
                </a>
            </div>

            <!-- Ícono 8: CECO -->
            <div class="col">
                <a href="#" class="menu-circle-item">
                    <div class="circle-icon-wrapper">
                        <!-- <img src="assets/img/icon-ceco.png" alt="CECO"> -->
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <span class="menu-circle-text">CECO</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Fin Menú de Accesos Rápidos (Grilla Fija de 8 Íconos 4x2) -->

    <!-- Feed de Programas Académicos -->
    <section id="programas-section" class="px-2" data-aos="fade-up">
        <div class="section-title-container">
            <h2 class="display-6 fw-bold mb-0">
                Nuestros Programas
            </h2>
           <a href="?page=programas" class="text-primary small fw-semibold text-decoration-none">Ver todos</a>
        </div>
        <div class="row g-2 px-2 mt-4">

            <?php if (!empty($programasDestacados)): ?>

                <?php foreach ($programasDestacados as $programa): ?>
                    <div class="col-6 col-md-3">
                        <div class="card feed-card">

                            <?php if (!empty($programa['ruta_archivo'])): ?>
                                <img src="/<?= htmlspecialchars($programa['ruta_archivo']) ?>"
                                    alt="<?= htmlspecialchars($programa['titulo']) ?>" class="card-img-top">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=400&q=80"
                                    alt="<?= htmlspecialchars($programa['titulo']) ?>" class="card-img-top">
                            <?php endif; ?>

                            <div class="card-body">
                                <div class="feed-card-title">
                                    <?= htmlspecialchars($programa['titulo']) ?>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="col-12 text-center py-4 text-muted">
                    <i class="bi bi-journal-x fs-2 d-block mb-2"></i>
                    Próximamente nuevos programas.
                </div>
            <?php endif; ?>

        </div>
    </section>
    <!-- Fin del feed de Programas Académicos -->

    <!-- Qué esperar de nuestros cursos -->
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">

            <!-- Encabezado -->
            <div class="text-center mb-5">
                <h2 class="fw-bold">¿Qué esperar de nuestros cursos?</h2>
                <p class="text-muted mx-auto" style="max-width: 700px;">
                    Una experiencia de aprendizaje diseñada para ayudarte a desarrollar
                    nuevas habilidades de forma flexible, práctica y profesional.
                </p>
            </div>

            <!-- Beneficios -->
            <div class="row g-4">

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-clock-history"></i>
                        <h5>Aprende a tu ritmo</h5>
                        <p>
                            Accede al contenido cuando quieras y avanza según tu disponibilidad.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-play-circle"></i>
                        <h5>Clases en alta calidad</h5>
                        <p>
                            Reproduce las lecciones las veces que necesites para reforzar tu aprendizaje.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-mortarboard"></i>
                        <h5>Docentes expertos</h5>
                        <p>
                            Aprende con profesionales que cuentan con experiencia real en su área.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-chat-dots"></i>
                        <h5>Interacción y acompañamiento</h5>
                        <p>
                            Resuelve dudas, comparte experiencias y recibe orientación durante tu formación.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-people"></i>
                        <h5>Comunidad de aprendizaje</h5>
                        <p>
                            Conecta con estudiantes que comparten tus intereses y objetivos profesionales.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="feature-card h-100">
                        <i class="bi bi-patch-check"></i>
                        <h5>Certificación</h5>
                        <p>
                            Obtén un certificado que respalde las competencias adquiridas en cada curso.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <!-- Fin Qué esperar de nuestros cursos -->

    <!-- Feed de Cursos Online -->
    <section id="cursos-section" class="px-2 pt-3" data-aos="fade-up">
        <div class="section-title-container">
            <h2 class="display-6 fw-bold mb-0">Cursos y Diplomados</h2>
           <a href="?page=programas" class="text-primary small fw-semibold text-decoration-none">Ver todos</a>
        </div>


        <div class="row g-2 px-2">

            <?php if (!empty($programasDestacados)): ?>

                <?php foreach ($programasDestacados as $programa): ?>
                    <div class="col-6 col-md-3">
                        <div class="card feed-card border border-success border-opacity-10">

                            <?php if (!empty($programa['ruta_archivo'])): ?>
                                <img src="/<?= htmlspecialchars($programa['ruta_archivo']) ?>" class="card-img-top"
                                    alt="<?= htmlspecialchars($programa['titulo']) ?>">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=300&q=80"
                                    class="card-img-top" alt="<?= htmlspecialchars($programa['titulo']) ?>">
                            <?php endif; ?>

                            <div class="card-body d-flex flex-column justify-content-between">
                                <h3 class="feed-card-title mb-2">
                                    <?= htmlspecialchars($programa['titulo']) ?>
                                </h3>
                                <div class="mt-auto">
                                    <p class="card-text text-muted small">
                                        <?= htmlspecialchars($programa['descripcion_corta'] ?? '') ?>
                                    </p>
                                    <a href="?page=programa&id=<?= $programa['id'] ?>"
                                        class="btn btn-success btn-sm w-100 btn-buy shadow-sm">
                                        Ver programa
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="col-12 text-center py-4 text-muted">
                    <i class="bi bi-journal-x fs-2 d-block mb-2"></i>
                    No hay cursos disponibles en este momento.
                </div>
            <?php endif; ?>

        </div>
    </section>
    <!-- Fin Feed de Cursos Online -->

    <!-- Sección de Aliados -->
    <section class="aliados-section" data-aos="fade-up">
        <div class="container text-center mb-4">
            <h2 class="section-title">Nuestros Aliados</h2>
            <div class="title-underline"></div>
            <p class="section-subtitle">Instituciones y empresas que confían en nuestra formación de calidad</p>
        </div>

        <div class="slider-wrapper">
            <div class="slider-track">
                <!-- Bloque Original (20 Logos) -->
                <div class="slide-item">
                    <img src="img/aliados/INESUP.png" alt="INESUP">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/LOGO-TRANSITO-Y-ALCALDIA-AZUL-scaled.png" alt="Tránsito y Alcaldía">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/alcaldia garagoa.png" alt="Alcaldía de Garagoa">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/cajacopi.png" alt="Cajacopi">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/edumas.png" alt="Edumas">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/la reformada.png" alt="La Reformada">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/lagit.png" alt="Lagit">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo Escuela conductores inteligentes.png"
                        alt="Escuela de Conductores Inteligentes">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo-cie_arcelona.png" alt="CIE Arcelona">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_CIC.png" alt="CIC">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_aciem.png" alt="ACIEM">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_asreales.png" alt="As Reales">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_brasilia.png" alt="Expreso Brasilia">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_institucion_universitaria_barranquilla.png"
                        alt="Institución Universitaria Barranquilla">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_intracienega.png" alt="Intraciénega">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_karbon sol.png" alt="Karbon Sol">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/naviera rio grande.png" alt="Naviera Río Grande">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/serviviosIntegrales.png" alt="Servicios Integrales">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/sise.png" alt="SISE">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/transito corozal.png" alt="Tránsito Corozal">
                </div>

                <!-- Bloque Duplicado (para el bucle infinito) -->
                <div class="slide-item">
                    <img src="img/aliados/INESUP.png" alt="INESUP">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/LOGO-TRANSITO-Y-ALCALDIA-AZUL-scaled.png" alt="Tránsito y Alcaldía">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/alcaldia garagoa.png" alt="Alcaldía de Garagoa">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/cajacopi.png" alt="Cajacopi">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/edumas.png" alt="Edumas">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/la reformada.png" alt="La Reformada">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/lagit.png" alt="Lagit">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo Escuela conductores inteligentes.png"
                        alt="Escuela de Conductores Inteligentes">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo-cie_arcelona.png" alt="CIE Arcelona">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_CIC.png" alt="CIC">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_aciem.png" alt="ACIEM">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_asreales.png" alt="As Reales">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_brasilia.png" alt="Expreso Brasilia">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_institucion_universitaria_barranquilla.png"
                        alt="Institución Universitaria Barranquilla">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_intracienega.png" alt="Intraciénega">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/logo_karbon sol.png" alt="Karbon Sol">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/naviera rio grande.png" alt="Naviera Río Grande">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/serviviosIntegrales.png" alt="Servicios Integrales">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/sise.png" alt="SISE">
                </div>
                <div class="slide-item">
                    <img src="img/aliados/transito corozal.png" alt="Tránsito Corozal">
                </div>
            </div>
        </div>
    </section>
    <!-- Fin Sección de Aliados -->

    <!-- Inicio CTA -->
    <section class="cta-section py-5" data-aos="fade-up">
        <div class="container text-center">
            <h2 class="display-5 fw-bold text-white mb-3">
                Optimiza tu experiencia hoy
            </h2>

            <p class="lead text-white-50 mb-4 mx-auto" style="max-width: 700px;">
                Descubre todas las ventajas de nuestra plataforma y comienza a obtener
                resultados de inmediato con una solución diseñada para impulsar tu crecimiento.
            </p>

            <a href="#" class="btn cta-btn btn-lg px-5 py-3">
                Comenzar ahora
            </a>

            <div class="mt-4">
                <small class="text-white-50">
                    Sin costos ocultos • Activación inmediata • Soporte especializado
                </small>
            </div>
        </div>
    </section>
    <!-- Fin CTA -->

    

    <!-- Footer -->
    <footer class="bg-white border-top py-4">
        <div class="container">
            <div class="row align-items-center text-center text-md-start">

                <!-- Información -->
                <div class="col-md-6 mb-3 mb-md-0">
                    <h6 class="fw-bold mb-1" style="color: var(--blue-main);">
                        CECO - Centro de Educación Continua de Oriente
                    </h6>
                    <p class="text-muted mb-0">
                        Calle 23 No 26-128, Soledad - Atlántico
                    </p>
                </div>

                <!-- Enlaces -->
                <div class="col-md-3 mb-3 mb-md-0">
                    <nav class="nav justify-content-center">
                        <a href="#" class="nav-link px-2 text-secondary small">Nosotros</a>
                        <a href="#" class="nav-link px-2 text-secondary small">Políticas</a>
                        <a href="#" class="nav-link px-2 text-secondary small">Términos</a>
                    </nav>
                </div>

                <!-- Copyright -->
                <div class="col-md-3 text-center text-md-end">
                    <small class="text-muted">
                        © 2026 CECO
                    </small>
                </div>

            </div>

            <hr class="my-3">

            <div class="text-center">
                <small class="text-muted">
                    Todos los derechos reservados.
                </small>
            </div>
        </div>
    </footer>
    <!-- Fin Footer -->


    <!-- Bootstrap 5.3.2 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>