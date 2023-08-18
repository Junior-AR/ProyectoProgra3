<?php
include __DIR__ . '/../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['idVenta'])) {
    $idVenta = $_GET['idVenta'];

    // Consulta para obtener los detalles de la venta por ID de Venta
    $query = "SELECT v.FechaVenta, v.ID_Cliente, v.ID_Producto, v.Total
              FROM Ventas v
              WHERE v.ID_Venta = ?";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idVenta);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $venta = $result->fetch_assoc();
        $response = array(
            'success' => true,
            'fechaVenta' => $venta['FechaVenta'],
            'idCliente' => $venta['ID_Cliente'],
            'idProducto' => $venta['ID_Producto'],
            'totalVenta' => $venta['Total']
        );
    } else {
        $response = array(
            'success' => false,
            'message' => 'ID de venta no encontrado.'
        );
    }
} else {
    $response = array(
        'success' => false,
        'message' => 'Solicitud inválida.'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>
