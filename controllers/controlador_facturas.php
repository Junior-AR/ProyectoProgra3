<?php
include __DIR__ . '/../includes/conexion.php';

function agregarFactura($idVenta, $idCliente, $idProducto, $fecha, $total) {
    global $mysqli;

    $query = "INSERT INTO Facturas (ID_Venta, ID_Cliente, ID_Producto, FechaFactura, MontoTotal) VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("iiiss", $idVenta, $idCliente, $idProducto, $fecha, $total);
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            echo "Error en la ejecución de la consulta: " . $stmt->error; // Agregar mensaje de error
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $mysqli->error; // Agregar mensaje de error
    }

    return false;
}

function obtenerFacturaPorID($idFactura) {
    global $mysqli;

    $query = "SELECT * FROM Facturas WHERE ID_Factura = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idFactura);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function editarFactura($idFactura, $idVenta, $idCliente, $idProducto, $fecha, $total) {
    global $mysqli;

    $query = "UPDATE Facturas SET ID_Venta = ?, ID_Cliente = ?, ID_Producto = ?, FechaFactura = ?, MontoTotal = ? WHERE ID_Factura = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iiissi", $idVenta, $idCliente, $idProducto, $fecha, $total, $idFactura);

    return $stmt->execute();
}

function eliminarFactura($idFactura) {
    global $mysqli;

    $query = "DELETE FROM Facturas WHERE ID_Factura = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idFactura);

    return $stmt->execute();
}

function listarFacturas() {
    global $mysqli;
    $facturas = array();

    $query = "SELECT f.*, v.FechaVenta, c.NombreCompleto AS NombreCliente, p.Nombre AS NombreProducto 
              FROM Facturas f
              INNER JOIN Ventas v ON f.ID_Venta = v.ID_Venta
              INNER JOIN Clientes c ON f.ID_Cliente = c.ID_Cliente
              INNER JOIN Productos p ON f.ID_Producto = p.ID_Producto"; 
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $facturas[] = $row;
        }
    }

    return $facturas;
}


?>
