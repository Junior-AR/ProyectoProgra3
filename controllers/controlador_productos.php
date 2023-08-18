<?php
include __DIR__ . '/../includes/conexion.php';

// Función para listar productos
function listarProductos() {
    global $mysqli;
    $productos = array();

    $query = "SELECT * FROM Productos";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $productos;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $productos[] = $row;
        }
    }

    return $productos;
}

function obtenerProductoPorID($id) {
    global $mysqli;

    $query = "SELECT * FROM Productos WHERE ID_Producto = '$id' LIMIT 1";
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

function agregarProducto($nombre, $descripcion, $precio, $cantidad) {
    global $mysqli;

    $query = "INSERT INTO Productos (Nombre, Descripcion, Precio, Cantidad) VALUES ('$nombre', '$descripcion', '$precio', '$cantidad')";
    $result = $mysqli->query($query);

    return $result;
}

function editarProducto($id, $nombre, $descripcion, $precio, $cantidad) {
    global $mysqli;

    $query = "UPDATE Productos SET Nombre = '$nombre', Descripcion = '$descripcion', Precio = '$precio', Cantidad = '$cantidad' WHERE ID_Producto = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarProducto($id) {
    global $mysqli;

    $query = "DELETE FROM Productos WHERE ID_Producto = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

?>
