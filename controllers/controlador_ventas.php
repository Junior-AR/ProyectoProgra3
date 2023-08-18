<?php
include __DIR__ . '/../includes/conexion.php';

function listarVentas() {
    global $mysqli;
    $ventas = array();

    $query = "SELECT v.*, c.NombreCompleto, p.Nombre AS NombreProducto FROM Ventas v
              INNER JOIN Clientes c ON v.ID_Cliente = c.ID_Cliente
              INNER JOIN Productos p ON v.ID_Producto = p.ID_Producto";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $ventas;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ventas[] = $row;
        }
    }

    return $ventas;
}


function obtenerVentaPorID($id) {
    global $mysqli;

    $query = "SELECT v.*, c.NombreCompleto, p.Nombre FROM Ventas v
              INNER JOIN Clientes c ON v.ID_Cliente = c.ID_Cliente
              INNER JOIN Productos p ON v.ID_Producto = p.ID_Producto
              WHERE v.ID_Venta = '$id' LIMIT 1";
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

function agregarVenta($idCliente, $idProducto, $fechaVenta, $total) {
    global $mysqli;

    $query = "INSERT INTO Ventas (ID_Cliente, ID_Producto, FechaVenta, Total) VALUES ('$idCliente', '$idProducto', '$fechaVenta', '$total')";
    $result = $mysqli->query($query);

    return $result;
}

function editarVenta($id, $idCliente, $idProducto, $fechaVenta, $total) {
    global $mysqli;

    $query = "UPDATE Ventas SET ID_Cliente = '$idCliente', ID_Producto = '$idProducto', FechaVenta = '$fechaVenta', Total = '$total' WHERE ID_Venta = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarVenta($id) {
    global $mysqli;

    $query = "DELETE FROM Ventas WHERE ID_Venta = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function generarFacturaVenta($idVenta) {
    global $mysqli;
    
    // Obtener los detalles de la venta
    $query = "SELECT * FROM Ventas WHERE ID_Venta = $idVenta";
    $result = $mysqli->query($query);

    if ($result->num_rows == 1) {
        $venta = $result->fetch_assoc();

        // Insertar los detalles de la venta como una factura
        $query = "INSERT INTO Facturas (ID_Venta, FechaFactura, TotalFactura)
                  VALUES ('$idVenta', '{$venta['FechaVenta']}', '{$venta['Total']}')";
        $result = $mysqli->query($query);

        if ($result) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>
