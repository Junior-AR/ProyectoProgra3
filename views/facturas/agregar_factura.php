<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../Css/index.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <!-- ... (código de navegación similar al de las otras páginas) ... -->
    </nav>

    <div class="container">
        <div class="card p-4 mx-auto col-md-8 ">
            <h2 class="card-title">Agregar Factura</h2>
            <?php include __DIR__ . '/../../includes/conexion.php'; ?>
            <?php include '../../Controllers/controlador_facturas.php'; ?>

            <form id="facturaForm" action="" method="post">
                <div class="mb-3">
                    <label for="idVenta" class="form-label">ID de Venta:</label>
                    <input type="number" id="idVenta" name="idVenta" class="form-control" value="<?php echo isset($_GET['idVenta']) ? $_GET['idVenta'] : ''; ?>" required>
                    <button type="button" class="btn btn-primary mt-2" id="verificarId">Verificar ID de Venta</button>
                </div>
                
                <div class="mb-3">
                    <label for="fechaVenta" class="form-label">Fecha de Venta:</label>
                    <input type="text" id="fechaVenta" name="fechaVenta" class="form-control" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="totalVenta" class="form-label">Total de Venta:</label>
                    <input type="text" id="totalVenta" name="totalVenta" class="form-control" readonly>
                </div>
                
                <!-- Otros campos para detalles de la factura -->
                <div class="mb-3">
                    <label for="idCliente" class="form-label">ID de Cliente:</label>
                    <input type="number" id="idCliente" name="idCliente" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="idProducto" class="form-label">ID de Producto:</label>
                    <input type="number" id="idProducto" name="idProducto" class="form-control" required>
                </div>
                
                <!-- Otros campos para detalles de la factura -->

                <button type="submit" class="btn btn-success">Agregar Factura</button>
            </form>
            
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idVenta = $_POST['idVenta'];
                $idCliente = $_POST['idCliente'];
                $idProducto = $_POST['idProducto'];
                $fechaVenta = $_POST['fechaVenta'];
                $totalVenta = $_POST['totalVenta'];
                
                $agregar = agregarFactura($idVenta, $idCliente, $idProducto, $fechaVenta, $totalVenta); // Llamada a la función para agregar la factura
        
                if ($agregar) {
                    header("Location: listar_facturas.php");
                    exit;
                } else {
                    echo '<div class="alert alert-danger mt-3" role="alert">Error al agregar la factura.</div>';
                }
            }
            ?>
        </div>
    </div>
    
    <footer class="footer">
        &copy; <?php echo date("Y"); ?> Sistema de Gestión - Verdulería JR
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para cargar los detalles de la venta al verificar el ID de venta
        function verificarIdVenta() {
            var idVenta = document.getElementById("idVenta").value;

            // Realizar solicitud AJAX al servidor para obtener los detalles de la venta
            $.ajax({
                url: '../../Controllers/obtener_detalles_venta.php',
                method: 'GET',
                data: { idVenta: idVenta },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        document.getElementById("fechaVenta").value = response.fechaVenta;
                        document.getElementById("totalVenta").value = response.totalVenta;
                        document.getElementById("idCliente").value = response.idCliente;
                        document.getElementById("idProducto").value = response.idProducto;
                        // Llenar otros campos de detalles de la factura aquí
                    } else {
                        alert('Error al obtener los detalles de la venta: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error en la solicitud AJAX: ' + error);
                }
            });
        }

        // Agregar un evento de clic al botón de verificar ID de venta
        var verificarIdButton = document.getElementById("verificarId");
        verificarIdButton.addEventListener("click", verificarIdVenta);
    </script>
</body>
</html>
