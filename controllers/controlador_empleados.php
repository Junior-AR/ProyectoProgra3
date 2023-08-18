<?php
include __DIR__ . '/../includes/conexion.php';

function listarEmpleados() {
    global $mysqli;
    $empleados = array();

    $query = "SELECT * FROM Empleados";
    $result = $mysqli->query($query);

    if (!$result) {
        echo "Error en la consulta: " . $mysqli->error;
        return $empleados;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $empleados[] = $row;
        }
    }

    return $empleados;
}

function obtenerEmpleadoPorID($id) {
    global $mysqli;

    $query = "SELECT * FROM Empleados WHERE ID_Empleado = '$id' LIMIT 1";
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

function agregarEmpleado($nombre, $cargo, $salario, $fechaContratacion) {
    global $mysqli;

    $query = "INSERT INTO Empleados (NombreCompleto, Cargo, Salario, FechaContratacion) VALUES ('$nombre', '$cargo', '$salario', '$fechaContratacion')";
    $result = $mysqli->query($query);

    return $result;
}

function editarEmpleado($id, $nombre, $cargo, $salario, $fechaContratacion) {
    global $mysqli;

    $query = "UPDATE Empleados SET NombreCompleto = '$nombre', Cargo = '$cargo', Salario = '$salario', FechaContratacion = '$fechaContratacion' WHERE ID_Empleado = '$id'";
    $result = $mysqli->query($query);

    return $result;
}

function eliminarEmpleado($id) {
    global $mysqli;

    $query = "DELETE FROM Empleados WHERE ID_Empleado = '$id'";
    $result = $mysqli->query($query);

    return $result;
}
?>
