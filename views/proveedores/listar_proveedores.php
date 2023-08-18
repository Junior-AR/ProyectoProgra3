<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Proveedores</title>
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
            <h2 class="card-title">Listado de Proveedores</h2>
            <div class="table-container">
                <?php include __DIR__ . '/../../includes/conexion.php'; ?>
                <?php include '../../Controllers/controlador_proveedores.php'; ?>

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $proveedores = listarProveedores();
                            foreach ($proveedores as $proveedor) {
                                echo '<tr>';
                                echo '<td>' . $proveedor['ID_Proveedor'] . '</td>';
                                echo '<td>' . $proveedor['Nombre'] . '</td>';
                                echo '<td>' . $proveedor['Contacto'] . '</td>';
                                echo '<td>' . $proveedor['Telefono'] . '</td>';
                                echo '<td>' . $proveedor['CorreoElectronico'] . '</td>';
                                echo '<td>
                                  <a href="ver_proveedor.php?id=' . $proveedor['ID_Proveedor'] . '" class="btn btn-primary btn-sm">Ver Detalles</a>
                                  <a href="editar_proveedor.php?id=' . $proveedor['ID_Proveedor'] . '" class="btn btn-warning btn-sm">Editar</a>
                                  <a href="eliminar_proveedor.php?id=' . $proveedor['ID_Proveedor'] . '" class="btn btn-danger btn-sm">Eliminar</a>
                              </td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 text-end">
                    <a href="agregar_proveedor.php" class="btn btn-success btn-sm">Agregar Proveedor</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
