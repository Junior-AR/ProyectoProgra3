<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
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
            <h2 class="card-title">Editar Empleado</h2>
            <?php
            include __DIR__ . '/../../includes/conexion.php';
            include  '../../Controllers/controlador_empleados.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $empleadoId = $_GET['id'];

                $empleado = obtenerEmpleadoPorID($empleadoId);

                if (!$empleado) {
                    echo '<div class="alert alert-danger" role="alert">Empleado no encontrado.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">ID de empleado no especificado.</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
                $nombre = $_POST['nombre'];
                $cargo = $_POST['cargo'];
                $salario = $_POST['salario'];
                $fechaContratacion = $_POST['fechaContratacion'];

                $editar = editarEmpleado($empleadoId, $nombre, $cargo, $salario, $fechaContratacion);

                if ($editar) {
                    header("Location: listar_empleados.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al editar el empleado.</div>';
                }
            }
            ?>

            <?php if ($empleado) : ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre Completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $empleado['NombreCompleto']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" value="<?php echo $empleado['Cargo']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="salario" class="form-label">Salario:</label>
                        <input type="number" id="salario" name="salario" step="0.01" class="form-control" value="<?php echo $empleado['Salario']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="fechaContratacion" class="form-label">Fecha de Contratación:</label>
                        <input type="date" id="fechaContratacion" name="fechaContratacion" class="form-control" value="<?php echo $empleado['FechaContratacion']; ?>" required>
                    </div>

                    <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <br>
                <a href="listar_empleados.php" class="btn btn-secondary">Volver al Listado de Empleados</a>
            <?php endif; ?>
        </div>
    </div>
    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
