<?php

require_once __DIR__ . '/../../../../app/Models/Programa.php';

$id = $_GET['id'] ?? null;

$programa = Programa::find($id);

if (!$programa) {
    die("Programa no encontrado");
}

$imagenHero = !empty($programa['imagen_principal'])
    ? BASE_URL . $programa['imagen_principal']
    : 'https://images.unsplash.com/photo-1501961271754-b3d84a3538b9?q=80&w=1770&auto=format&fit=crop';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
     CECO · <?= htmlspecialchars($programa['titulo']) ?>
    </title>
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <!-- Estilos propios -->
    <link rel="stylesheet" href="/../../../../css/programas.css">

</head>
<body>

    <div class="main-bg">

        <!-- ====== HERO CON IMAGEN FULL WIDTH ====== -->
        <header class="hero-full">

            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="<?= BASE_URL ?>index.php">
                        <img src="<?= BASE_URL ?>img/logo.png" alt="Logo CECO" class="img-fluid"
                            style="max-height:40px; width:auto;">
                    </a>

                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link" href="<?= BASE_URL ?>index.php">Inicio</a>
                            <a class="nav-link" href="#">Institución</a>
                            <a class="nav-link active" href="#">Técnico Laboral</a>
                            <a class="nav-link" href="?page=programas">Cursos</a>
                            <a class="nav-link" href="#">Noticias</a>
                            <a class="nav-link" href="#">Contáctenos</a>
                            <a class="ms-lg-3 btn btn-contacto align-self-center" href="?page=login">Login</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Fondo -->
            <div class="hero-bg" style="background-image:url('<?= htmlspecialchars($imagenHero) ?>');">
            </div>

            <div class="hero-overlay"></div>

            <!-- Contenido -->
            <div class="container text-center hero-content">
                <span class="tagline">
                    <i class="fas fa-bus me-2"></i> Formación Técnica
                </span>

                <h1 class="my-3">
                    Técnico Laboral en <br>
                    <span class="highlight">
                        <?= htmlspecialchars($programa['titulo']) ?>
                    </span>
                </h1>

                <p class="subtitle">
                    Adquiere competencias para el sector logístico-portuario con formación integral y reconocimiento oficial.
                    <strong class="fw-bold d-block mt-2" style="color: #FFE484;">¡Tu futuro en el puerto comienza aquí!</strong>
                </p>

                <div class="d-flex flex-wrap gap-3 justify-content-center">
                    <a href="#" class="btn btn-primary-custom">
                        <i class="fas fa-paper-plane me-2"></i> Inscríbete ahora
                    </a>

                    
                </div>
            </div>

        </header>

        <div class="container">

            <!-- ====== TARJETA DE PROGRAMA ====== -->
            <div class="card-custom p-4 p-md-5 my-4 animate-on-scroll" style="margin-top: -4rem !important; position: relative; z-index: 5; background: rgba(255,255,255,0.98); backdrop-filter: blur(2px);">
                <div class="row g-4 text-center">
                    <div class="col-6 col-md program-item">
                        <div class="label"><i class="fas fa-certificate"></i> Certificado</div>
                        <div class="value">Técnico Laboral</div>
                    </div>
                    <div class="col-6 col-md program-item">
                        <div class="label"><i class="fas fa-clock"></i> Duración</div>
                        <div class="value">
                            <?= htmlspecialchars($programa['duracion']) ?>
                        </div>
                    </div>
                    <div class="col-6 col-md program-item">
                        <div class="label"><i class="fas fa-tag"></i> Precio</div>
                        <div class="value highlight">$ 5.000.000</div>
                        <small class="text-muted">Pregunta por formas de pago</small>
                    </div>
                    <div class="col-6 col-md program-item">
                        <div class="label"><i class="fas fa-building"></i> Unidad</div>
                        <div class="value">CECO</div>
                    </div>
                    <div class="col-6 col-md program-item">
                        <div class="label"><i class="fas fa-check-circle"></i> Registro</div>
                        <div class="value">0822-4</div>
                        <small class="text-muted">04 de Diciembre de 2023</small>
                    </div>
                </div>
            </div>

            <!-- ====== ¿QUÉ ES? ====== -->
            <section class="text-center my-5 animate-on-scroll">
                <h2 class="section-title">¿Qué es <span class="highlight">este programa?</span></h2>
                <div class="section-divider"></div>
                <p class="section-sub">
                    El Técnico Laboral por Competencia en Logística Portuaria te prepara para aplicar procesos operativos, de manejo de carga y coordinación logística en el entorno portuario, con un enfoque práctico y alineado a la normativa vigente.
                </p>
            </section>

            <!-- ====== CARACTERÍSTICAS ====== -->
            <div class="row g-4 my-5">
                <div class="col-md-4 animate-on-scroll">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-anchor feature-icon"></i>
                        <h3 class="mt-3" style="color: var(--text-dark);">Operaciones portuarias</h3>
                        <p class="text-muted">Desarrolla habilidades en manejo de carga, estiba y operaciones de muelle.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-truck feature-icon"></i>
                        <h3 class="mt-3" style="color: var(--text-dark);">Logística y transporte</h3>
                        <p class="text-muted">Aprende a gestionar procesos logísticos y de transporte en el entorno portuario.</p>
                    </div>
                </div>
                <div class="col-md-4 animate-on-scroll">
                    <div class="card-custom p-4 text-center h-100">
                        <i class="fas fa-user-graduate feature-icon"></i>
                        <h3 class="mt-3" style="color: var(--text-dark);">Perfil competitivo</h3>
                        <p class="text-muted">Egresarás con un perfil técnico que responde a las necesidades del sector portuario.</p>
                    </div>
                </div>
            </div>

            <!-- ====== PERFILES ====== -->
            <section class="my-5">
                <h2 class="section-title text-center">Perfiles <span class="highlight">del programa</span></h2>
                <div class="section-divider"></div>
                <div class="row g-4 mt-3">
                    <div class="col-md-6 animate-on-scroll">
                        <div class="profile-box">
                            <h3><i class="fas fa-user-plus" style="color: var(--accent-color);"></i> Aspirante</h3>
                            <ul>
                                <li>Interés en adquirir conocimientos para el área de operaciones logísticas.</li>
                                <li>Disponibilidad para formación práctica y teórica.</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 animate-on-scroll">
                        <div class="profile-box">
                            <h3><i class="fas fa-user-tie" style="color: var(--accent-color);"></i> Egresado</h3>
                            <ul>
                                <li>Operario de muelle</li>
                                <li>Operario portuario</li>
                                <li>Portalonero</li>
                                <li>Tanquero</li>
                                <li>Tarjador</li>
                                <li>Trabajador de muelle</li>
                                <li>Trabajador portuario</li>
                                <li>Winchero</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ====== DOCUMENTOS ====== -->
            <section class="my-5 animate-on-scroll">
                <h2 class="section-title text-center">Documentos <span class="highlight">requeridos</span></h2>
                <div class="section-divider"></div>
                <div class="card-custom p-4 p-md-5 mt-3">
                    <div class="d-flex flex-wrap gap-3 justify-content-center">
                        <span class="doc-item"><i class="fas fa-file-alt"></i> Diploma y acta de grado (9°)</span>
                        <span class="doc-item"><i class="fas fa-heartbeat"></i> Afiliación a salud</span>
                        <span class="doc-item"><i class="fas fa-id-card"></i> Documento de identidad</span>
                        <span class="doc-item"><i class="fas fa-camera"></i> Foto 3x4 fondo azul</span>
                    </div>
                </div>
            </section>

            <!-- ====== LOGOS ====== -->
            <div class="logos d-flex flex-wrap justify-content-center gap-4 py-4 my-4 border-top border-bottom" style="border-color: rgba(0,0,0,0.05) !important;">
                <span>CECO</span>
                <span>Registro S.E.S</span>
                <span>Educación Continua</span>
                <span>Logística Portuaria</span>
            </div>

        </div> <!-- end container -->
    </div> <!-- end main-bg -->

    <!-- ====== FOOTER ====== -->
    <footer class="footer-custom">
        <div class="container text-center">
            <p>
                <i class="fas fa-map-pin"></i> Centro de Educación Continua de Oriente CECO ·
                <a href="#">ceco.edu.co</a> ·
                <i class="fas fa-phone"></i> +57 300 000 0000
            </p>
            <p class="mt-2" style="font-size: 0.8rem; opacity: 0.7;">
                &copy; 2026 CECO. Todos los derechos reservados. | Programa autorizado por S.E.S.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Animación de entrada -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.2 });

            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>

</body>
</html>