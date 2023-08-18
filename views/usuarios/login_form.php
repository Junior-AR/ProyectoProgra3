<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../../Css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($_GET['error']) && $_GET['error'] == 1) : ?>
            <p class="error-message">Credenciales incorrectas. Inténtalo de nuevo.</p>
        <?php endif; ?>
        <form class="login-form" action="../usuarios/procesar_login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button class="login-button" type="submit">Iniciar Sesión</button>
        </form>
        <p class="register-link">¿No tienes cuenta? <a href="formulario_registro.php">Regístrate</a></p>
    </div>
</body>
</html>
