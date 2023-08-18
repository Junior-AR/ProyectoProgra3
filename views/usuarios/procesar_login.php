<?php
include __DIR__ . '/../../includes/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena']; // Cambiado de 'password' a 'contrasena'

    // Evitar inyección de SQL usando sentencias preparadas
    $query = "SELECT * FROM Usuarios WHERE Usuario = ? AND Password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['inicio_sesion'] = true;
        $_SESSION['usuario'] = $usuario;
        header("Location: ../../index.php"); 
        exit;
    } else {
        header("Location: login_form.php?error=1"); 
        exit;
    }

}
?>
