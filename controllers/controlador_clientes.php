<?php
include __DIR__ . '/../includes/conexion.php';

// Función para listar clientes
function listarClientes() {
    global $mysqli;
    $clientes = array();

    $query = "SELECT * FROM Clientes";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $clientes;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clientes[] = $row;
        }
    }

    return $clientes;
}

function obtenerClientePorID($id) {
    global $mysqli;

    $query = "SELECT * FROM Clientes WHERE ID_Cliente = '$id' LIMIT 1";
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

function agregarCliente($nombreCompleto, $direccion, $telefono, $correoElectronico) {
    global $mysqli;

    $query = "INSERT INTO Clientes (NombreCompleto, Direccion, Telefono, CorreoElectronico) VALUES ('$nombreCompleto', '$direccion', '$telefono', '$correoElectronico')";
    $result = $mysqli->query($query);

    return $result;
}

function editarCliente($id, $nombreCompleto, $direccion, $telefono, $correoElectronico) {
    global $mysqli;

    $query = "UPDATE Clientes SET NombreCompleto = '$nombreCompleto', Direccion = '$direccion', Telefono = '$telefono', CorreoElectronico = '$correoElectronico' WHERE ID_Cliente = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarCliente($id) {
    global $mysqli;

    $query = "DELETE FROM Clientes WHERE ID_Cliente = '$id'";
    $result = $mysqli->query($query);

    return $result;
}
?>
