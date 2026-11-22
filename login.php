<?php
session_start();
require_once 'db.php'; // debe contener la conexión $conn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $admin = $resultado->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_nombre'] = $admin['nombre'];
            header("Location: dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        header("Location: index.php?error=Usuario no encontrado");
        exit();
    }
}
?>
