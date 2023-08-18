<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Factura</title>
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
        <div class="card p-4">
            <h2 class="card-title">Detalles de la Factura</h2>
            <?php include __DIR__ . '/../../includes/conexion.php'; ?>
            <?php include  '../../Controllers/controlador_facturas.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $facturaId = $_GET['id'];

                $factura = obtenerFacturaPorID($facturaId);

                if (!$factura) {
                    echo '<div class="alert alert-danger mt-3" role="alert">Factura no encontrada.</div>';
                }
            } else {
                echo '<div class="alert alert-danger mt-3" role="alert">ID de factura no especificado.</div>';
            }
            ?>

            <?php if ($factura) : ?>
                <div class="mb-3">
                    <p><strong>ID:</strong> <?php echo $factura['ID_Factura']; ?></p>
                    <p><strong>Venta ID:</strong> <?php echo $factura['ID_Venta']; ?></p>
                    <p><strong>Cliente ID:</strong> <?php echo $factura['ID_Cliente']; ?></p>
                    <p><strong>Producto ID:</strong> <?php echo $factura['ID_Producto']; ?></p>
                    <p><strong>Fecha de Factura:</strong> <?php echo $factura['FechaFactura']; ?></p>
                    <p><strong>Total:</strong> <?php echo $factura['MontoTotal']; ?></p>
                </div>

                <div class="mb-3">
                    <a href="listar_facturas.php" class="btn btn-primary">Volver al Listado de Facturas</a>
                    <a href="generar_factura_pdf.php?idFactura=<?php echo $factura['ID_Factura']; ?>" class="btn btn-success" target="_blank">Generar PDF</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
