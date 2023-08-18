<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
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
            <h2 class="card-title">Editar Factura</h2>
            <?php include __DIR__ . '/../../includes/conexion.php'; ?>
            <?php include __DIR__ . '/../../Controllers/controlador_facturas.php'; ?>

            <?php
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $facturaId = $_GET['id'];

                $factura = obtenerFacturaPorID($facturaId);

                if (!$factura) {
                    echo '<div class="alert alert-danger" role="alert">Factura no encontrada.</div>';
                }
            } else {
                echo '<div class="alert alert-danger" role="alert">ID de factura no especificado.</div>';
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
                $idVenta = $_POST['venta'];
                $idCliente = $_POST['cliente'];
                $idProducto = $_POST['producto'];
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];

                $editar = editarFactura($facturaId, $idVenta, $idCliente, $idProducto, $fecha, $total);

                if ($editar) {
                    header("Location: listar_facturas.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error al editar la factura.</div>';
                }
            }
            ?>

            <?php if ($factura) : ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="venta" class="form-label">Venta ID:</label>
                        <input type="number" id="venta" name="venta" class="form-control" value="<?php echo $factura['ID_Venta']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente ID:</label>
                        <input type="number" id="cliente" name="cliente" class="form-control" value="<?php echo $factura['ID_Cliente']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="producto" class="form-label">Producto ID:</label>
                        <input type="number" id="producto" name="producto" class="form-control" value="<?php echo $factura['ID_Producto']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de Factura:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" value="<?php echo $factura['FechaFactura']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="total" class="form-label">Total:</label>
                        <input type="number" id="total" name="total" step="0.01" class="form-control" value="<?php echo $factura['MontoTotal']; ?>" required>
                    </div>

                    <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
                </form>
                <br>
                <a href="listar_facturas.php" class="btn btn-secondary">Volver al Listado de Facturas</a>
            <?php endif; ?>
        </div>
    </div>
    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
