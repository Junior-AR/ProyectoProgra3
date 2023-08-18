<?php
include __DIR__ . '/../includes/conexion.php'; // Ajusta la ruta según tu estructura

// Función para listar proveedores
function listarProveedores() {
    global $mysqli;
    $proveedores = array();

    $query = "SELECT * FROM Proveedores";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $proveedores;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $proveedores[] = $row;
        }
    }

    return $proveedores;
}

function obtenerProveedorPorID($id) {
    global $mysqli;

    $query = "SELECT * FROM Proveedores WHERE ID_Proveedor = '$id' LIMIT 1";
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

function agregarProveedor($nombre, $contacto, $telefono, $correo) {
    global $mysqli;

    $query = "INSERT INTO Proveedores (Nombre, Contacto, Telefono, CorreoElectronico) VALUES ('$nombre', '$contacto', '$telefono', '$correo')";
    $result = $mysqli->query($query);

    return $result;
}

function editarProveedor($id, $nombre, $contacto, $telefono, $correo) {
    global $mysqli;

    $query = "UPDATE Proveedores SET Nombre = '$nombre', Contacto = '$contacto', Telefono = '$telefono', CorreoElectronico = '$correo' WHERE ID_Proveedor = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarProveedor($id) {
    global $mysqli;

    $query = "DELETE FROM Proveedores WHERE ID_Proveedor = '$id'";
    $result = $mysqli->query($query);

    return $result;
}
?>
