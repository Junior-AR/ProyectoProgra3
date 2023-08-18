<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
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
        <div class="card p-4 mx-auto col-md-8">
            <h2 class="card-title">Editar Proveedor</h2>
            <?php
            include __DIR__ . '/../../includes/conexion.php';
            include  '../../Controllers/controlador_proveedores.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $proveedorId = $_GET['id'];

                $proveedor = obtenerProveedorPorID($proveedorId);

                if (!$proveedor) {
                    echo "Proveedor no encontrado.";
                }
            } else {
                echo "ID de proveedor no especificado.";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
                $nombre = $_POST['nombre'];
                $contacto = $_POST['contacto'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];

                $editar = editarProveedor($proveedorId, $nombre, $contacto, $telefono, $correo);

                if ($editar) {
                    header("Location: listar_proveedores.php");
                    exit;
                } else {
                    echo "Error al editar el proveedor.";
                }
            }
            ?>

            <?php if ($proveedor) : ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $proveedor['Nombre']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="contacto" class="form-label">Persona de Contacto:</label>
                        <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo $proveedor['Contacto']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $proveedor['Telefono']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $proveedor['CorreoElectronico']; ?>" required>
                    </div>

                    <button type="submit" name="editar" class="btn btn-success">Guardar Cambios</button>
                </form>
                <br>
                <a href="listar_proveedores.php" class="btn btn-primary">Volver al Listado de Proveedores</a>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
