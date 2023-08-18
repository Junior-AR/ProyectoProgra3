<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Css/index.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../../index.php">
                <img src="../../images/chile.png" alt="inicio" width="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../clientes/listar_clientes.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../productos/listar_productos.php">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pedidos/listar_pedidos.php">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../proveedores/listar_proveedores.php">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../empleados/listar_empleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../ventas/listar_ventas.php">Ventas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../facturas/listar_facturas.php">Facturas</a>
                    </li>
                </ul>
                <a class="btn btn-danger ml-auto" href="../usuarios/cerrar_sesion.php">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="card p-4 mx-auto col-md-8 ">
            <h2 class="card-title">Editar Cliente</h2>
            <?php
            include __DIR__ . '/../../includes/conexion.php';
            include '../../Controllers/controlador_clientes.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $clienteId = $_GET['id'];

                $cliente = obtenerClientePorID($clienteId);

                if (!$cliente) {
                    echo "<p>Cliente no encontrado.</p>";
                }
            } else {
                echo "<p>ID de cliente no especificado.</p>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
                $nombreCompleto = $_POST['nombreCompleto'];
                $direccion = $_POST['direccion'];
                $telefono = $_POST['telefono'];
                $correoElectronico = $_POST['correoElectronico'];

                $editar = editarCliente($clienteId, $nombreCompleto, $direccion, $telefono, $correoElectronico);

                if ($editar) {
                    header("Location: listar_clientes.php");
                    exit;
                } else {
                    echo "<p>Error al editar el cliente.</p>";
                }
            }
            ?>

            <?php if ($cliente) : ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="nombreCompleto" class="form-label">Nombre Completo:</label>
                        <input type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $cliente['NombreCompleto']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" value="<?php echo $cliente['Direccion']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" id="telefono" name="telefono" value="<?php echo $cliente['Telefono']; ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="correoElectronico" class="form-label">Correo Electrónico:</label>
                        <input type="email" id="correoElectronico" name="correoElectronico" value="<?php echo $cliente['CorreoElectronico']; ?>" class="form-control" required>
                    </div>

                    <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <br>
                <a href="listar_clientes.php" class="btn btn-secondary">Volver al Listado de Clientes</a>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>