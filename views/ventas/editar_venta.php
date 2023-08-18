<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Venta</title>
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
            <h2 class="card-title">Editar Venta</h2>
            <?php include __DIR__ . '/../../includes/conexion.php'; ?>
            <?php include '../../Controllers/controlador_ventas.php'; ?>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $ventaID = $_GET['id'];
                $clienteID = $_POST['clienteID'];
                $productoID = $_POST['productoID'];
                $fecha = $_POST['fecha'];
                $total = $_POST['total'];

                $editar = editarVenta($ventaID, $clienteID, $productoID, $fecha, $total);

                if ($editar) {
                    header("Location: listar_ventas.php");
                    exit;
                } else {
                    echo "Error al editar la venta.";
                }
            } else {
                $ventaID = $_GET['id'];
                $venta = obtenerVentaPorID($ventaID);

                if (!$venta) {
                    echo "Venta no encontrada.";
                    exit;
                }
            }
            ?>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="clienteID" class="form-label">Cliente ID:</label>
                    <input type="number" class="form-control" id="clienteID" name="clienteID" value="<?php echo $venta['ID_Cliente']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="productoID" class="form-label">Producto ID:</label>
                    <input type="number" class="form-control" id="productoID" name="productoID" value="<?php echo $venta['ID_Producto']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de Venta:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $venta['FechaVenta']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="total" class="form-label">Total:</label>
                    <input type="number" class="form-control" id="total" name="total" value="<?php echo $venta['Total']; ?>" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </form>
            <br>
            <a href="listar_ventas.php" class="btn btn-primary mt-3">Volver al Listado de Ventas</a>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
