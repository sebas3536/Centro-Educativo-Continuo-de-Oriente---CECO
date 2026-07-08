<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/normalize.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="login-bg">

    <!-- BACKGROUND LAYER -->

    <a href="?page=homew" class="btn btn-link text-decoration-none position-absolute m-2">
        <i class="bi bi-arrow-left fs-4"></i>
    </a>

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-4">

            <!-- CARD -->
            <div class="card login-card border-0 shadow-lg">

                <!-- HEADER -->
                <div class="card-header text-center border-0 bg-transparent pt-4">

                    <div class="icon-circle mb-3">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <h4 class="fw-semibold mb-1">Bienvenido</h4>

                    <p class="text-muted small mb-0">
                        Inicia sesión para continuar
                    </p>
                </div>

                <!-- BODY -->
                <div class="card-body px-4 py-4">

                    <form method="POST" action="?page=login_process">

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label class="form-label small text-muted">Correo electrónico</label>
                            <input type="email" name="email" class="form-control form-control-lg"
                                placeholder="correo@ejemplo.com" required>
                        </div>

                        <!-- PASSWORD -->
                        <div class="mb-3">
                            <label class="form-label small text-muted">Contraseña</label>
                            <input type="password" name="password" class="form-control form-control-lg"
                                placeholder="••••••••" required>
                        </div>

                        <!-- ERROR -->
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger d-flex align-items-center gap-2 py-2 small">
                                <i class="bi bi-exclamation-triangle"></i>
                                Credenciales inválidas
                            </div>
                        <?php endif; ?>

                        <!-- BUTTON -->
                        <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                            Entrar
                            <i class="bi bi-arrow-right ms-1"></i>
                        </button>

                    </form>

                </div>

                <!-- FOOTER -->
                <div class="card-footer text-center border-0 bg-transparent pb-4">
                    <small class="text-muted">
                        © <?php echo date('Y'); ?>
                    </small>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>