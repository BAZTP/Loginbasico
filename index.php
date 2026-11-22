<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Ingreso de Administrador</h4>
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo htmlspecialchars($_GET['error']); ?>
                            </div>
                        <?php endif; ?>
                        <form action="login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
                        </form>

                        <!-- Acceso para crear nuevo usuario -->
                        <div class="mt-3 text-center">
                            <a href="crearusuario.php" class="btn btn-link">¿Nuevo administrador? Crear cuenta</a>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-3"><small>© 2025 Sistema Seguro</small></p>
            </div>
        </div>
    </div>
</body>
</html>
