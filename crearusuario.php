<?php
require_once 'db.php';

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmar = $_POST['confirmar'];

    if ($password !== $confirmar) {
        $mensaje = "<div class='alert alert-warning text-center'>Las contraseñas no coinciden.</div>";
    } else {
        // Verificar si el email ya está registrado
        $stmt = $conn->prepare("SELECT id FROM admin WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $mensaje = "<div class='alert alert-danger text-center'>Este correo ya está registrado.</div>";
        } else {
            // Insertar nuevo administrador
            $password_segura = password_hash($password, PASSWORD_BCRYPT);
            $insert = $conn->prepare("INSERT INTO admin (nombre, email, password) VALUES (?, ?, ?)");
            $insert->bind_param("sss", $nombre, $email, $password_segura);

            if ($insert->execute()) {
                $mensaje = "<div class='alert alert-success text-center'>Usuario creado exitosamente. <a href='index.php'>Iniciar sesión</a></div>";
            } else {
                $mensaje = "<div class='alert alert-danger text-center'>Error al registrar usuario.</div>";
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h4 class="text-center mb-4">Registrar Administrador</h4>

                        <?php echo $mensaje; ?>

                        <form action="crearusuario.php" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmar" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="confirmar" required>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Crear Cuenta</button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="index.php" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-3"><small>© 2025 Sistema Seguro</small></p>
            </div>
        </div>
    </div>
</body>
</html>
