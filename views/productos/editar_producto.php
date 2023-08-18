<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
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
            <h2 class="card-title">Editar Producto</h2>
            <?php
            include __DIR__ . '/../../includes/conexion.php';
            include '../../Controllers/controlador_productos.php';

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $productoId = $_GET['id'];

                $producto = obtenerProductoPorID($productoId);

                if (!$producto) {
                    echo "Producto no encontrado.";
                }
            } else {
                echo "ID de producto no especificado.";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $precio = $_POST['precio'];
                $cantidad = $_POST['cantidad'];

                $editar = editarProducto($productoId, $nombre, $descripcion, $precio, $cantidad);

                if ($editar) {
                    header("Location: listar_productos.php");
                    exit;
                } else {
                    echo "Error al editar el producto.";
                }
            }
            ?>

            <?php if ($producto) : ?>
                <form method="post">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['Nombre']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['Descripcion']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo $producto['Precio']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $producto['Cantidad']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success" name="editar">Guardar Cambios</button>
                </form>
                <br>
                <a href="listar_productos.php" class="btn btn-primary mt-3">Volver al Listado de Productos</a>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>