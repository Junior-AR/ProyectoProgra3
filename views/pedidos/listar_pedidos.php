<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Pedidos</title>
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
            <h2 class="card-title">Listado de Pedidos</h2>
            <?php include __DIR__ . '/../../includes/conexion.php'; ?>
            <?php include '../../Controllers/controlador_pedidos.php'; ?>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>ID Producto</th>
                            <th>ID Proveedor</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pedidos = listarPedidos();
                        foreach ($pedidos as $pedido) {
                            echo '<tr>';
                            echo '<td>' . $pedido['ID_Pedido'] . '</td>';
                            echo '<td>' . $pedido['NombreProducto'] . '</td>';
                            echo '<td>' . $pedido['NombreProveedor'] . '</td>';
                            echo '<td>' . $pedido['FechaPedido'] . '</td>';
                            echo '<td>' . $pedido['Estado'] . '</td>';
                            echo '<td>
                                      <a class="btn btn-primary btn-sm" href="ver_pedido.php?id=' . $pedido['ID_Pedido'] . '">Ver Detalles</a>
                                      <a class="btn btn-warning btn-sm" href="editar_pedido.php?id=' . $pedido['ID_Pedido'] . '">Editar</a>
                                      <a class="btn btn-danger btn-sm" href="eliminar_pedido.php?id=' . $pedido['ID_Pedido'] . '">Eliminar</a>
                                  </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="mt-3 text-end">
                <a class="btn btn-success btn-sm " href="agregar_pedido.php">Agregar Pedido</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
