<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../../Css/register.css">
    <script>
        function mostrarMensaje() {
            var mensaje = "Usuario creado exitosamente.\n\n";
            mensaje += "Haz clic en 'Iniciar sesión' para ingresar.";

            alert(mensaje);
            window.location.href = "./login_form.php";
        }
    </script>
</head>

<body>
    <div class="register-container">
        <h2>Registro de Usuario</h2>
        <?php
        include __DIR__ . '/../../includes/conexion.php';

        $mensajeError = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $_POST['usuario'];
            $contrasena = $_POST['contrasena'];

            // Verificar si el usuario ya existe en la base de datos
            $verificarUsuario = "SELECT ID_Usuario FROM Usuarios WHERE Usuario = ?";
            $stmtVerificar = $mysqli->prepare($verificarUsuario);
            $stmtVerificar->bind_param("s", $usuario);
            $stmtVerificar->execute();
            $stmtVerificar->store_result();

            if ($stmtVerificar->num_rows > 0) {
                $mensajeError = "El usuario ya existe, por favor intente de nuevo.";
            } else {
                $stmtVerificar->close();

                $sql = "INSERT INTO Usuarios (Usuario, Password) VALUES (?, ?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ss", $usuario, $contrasena);

                if ($stmt->execute()) {
                    echo '<script>mostrarMensaje();</script>';
                } else {
                    echo "Error al registrar el usuario.";
                }

                $stmt->close();
            }

            $mysqli->close();
        }
        ?>

        <form class="register-form" action="" method="post">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button class="register-button" type="submit">Registrarse</button>
        </form>
        <?php if (!empty($mensajeError)) : ?>
            <p class="error-message"><?php echo $mensajeError; ?></p>
        <?php endif; ?>
        <p class="login-link">¿Ya tienes cuenta? <a href="./login_form.php">Inicia Sesión</a></p>
    </div>
</body>

</html>
