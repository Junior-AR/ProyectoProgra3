<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Proveedor</title>
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
            <h2 class="card-title">Detalles del Proveedor</h2>
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
            ?>

            <?php if ($proveedor) : ?>
                <p><strong>ID:</strong> <?php echo $proveedor['ID_Proveedor']; ?></p>
                <p><strong>Nombre:</strong> <?php echo $proveedor['Nombre']; ?></p>
                <p><strong>Contacto:</strong> <?php echo $proveedor['Contacto']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $proveedor['Telefono']; ?></p>
                <p><strong>Correo Electrónico:</strong> <?php echo $proveedor['CorreoElectronico']; ?></p>

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
