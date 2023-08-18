<?php

include __DIR__ . '/../../fpdf/fpdf.php';
include __DIR__ . '/../../includes/conexion.php'; // Ajusta la ruta según tu estructura

class PDF extends FPDF
{
    function Header()
    {
        // Encabezado
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'Factura', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

if (isset($_GET['idFactura'])) {
    $idFactura = $_GET['idFactura'];
    
    $query = "SELECT f.*, v.FechaVenta, c.NombreCompleto AS NombreCliente, p.Nombre AS NombreProducto
              FROM Facturas f
              INNER JOIN Ventas v ON f.ID_Venta = v.ID_Venta
              INNER JOIN Clientes c ON f.ID_Cliente = c.ID_Cliente
              INNER JOIN Productos p ON f.ID_Producto = p.ID_Producto
              WHERE f.ID_Factura = ?";
    
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $idFactura);
    $stmt->execute();

    $result = $stmt->get_result();
    
    if ($result && $result->num_rows === 1) {
        $factura = $result->fetch_assoc();
        
        // Crear instancia de PDF
        $pdf = new PDF();
        $pdf->AddPage();

        // Contenido de la factura
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Detalles de la factura:', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, 'Fecha: ' . $factura['FechaFactura'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Cliente: ' . $factura['NombreCliente'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Producto: ' . $factura['NombreProducto'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Total: $' . $factura['MontoTotal'], 0, 1, 'L');
        
        // Agregar una línea divisoria
        $pdf->SetLineWidth(0.5);
        $pdf->Line(10, $pdf->GetY() + 10, 200, $pdf->GetY() + 10);
        $pdf->Ln(15);
        
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Gracias por su compra', 0, 1, 'C');

        // Guardar el PDF en el navegador
        $pdf->Output();
    } else {
        echo "Factura no encontrada.";
    }
} else {
    echo "ID de factura no especificado.";
}
?>
