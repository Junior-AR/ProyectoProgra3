<?php
include __DIR__ . '/../includes/conexion.php';

// Función para listar pedidos
function listarPedidos() {
    global $mysqli;
    $pedidos = array();

    $query = "SELECT p.*, pr.Nombre AS NombreProveedor, pd.Nombre AS NombreProducto FROM Pedidos p
              INNER JOIN Proveedores pr ON p.ID_Proveedor = pr.ID_Proveedor
              INNER JOIN Productos pd ON p.ID_Producto = pd.ID_Producto";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $pedidos;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pedidos[] = $row;
        }
    }

    return $pedidos;
}

function obtenerPedidoPorID($id) {
    global $mysqli;

    $query = "SELECT p.*, pr.Nombre AS NombreProveedor, pd.Nombre AS NombreProducto FROM Pedidos p
              INNER JOIN Proveedores pr ON p.ID_Proveedor = pr.ID_Proveedor
              INNER JOIN Productos pd ON p.ID_Producto = pd.ID_Producto
              WHERE p.ID_Pedido = '$id' LIMIT 1";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return null;
    }

    if ($result->num_rows === 1) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function agregarPedido($productoID, $proveedorID, $fecha, $estado) {
    global $mysqli;

    $query = "INSERT INTO Pedidos (ID_Producto, ID_Proveedor, FechaPedido, Estado) 
              VALUES ('$productoID', '$proveedorID', '$fecha', '$estado')";
    $result = $mysqli->query($query);

    return $result;
}

function editarPedido($id, $productoID, $proveedorID, $fecha, $estado) {
    global $mysqli;

    $query = "UPDATE Pedidos SET ID_Producto = '$productoID', ID_Proveedor = '$proveedorID', 
              FechaPedido = '$fecha', Estado = '$estado' WHERE ID_Pedido = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarPedido($id) {
    global $mysqli;

    $query = "DELETE FROM Pedidos WHERE ID_Pedido = '$id'";
    $result = $mysqli->query($query);

    return $result;
}
?>
