<?php
include 'conexion.php';
date_default_timezone_set('America/El_Salvador');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Reporte_Productos_'.date('Ymd').'.csv');

$output = fopen('php://output', 'w');

// Encabezados
fputcsv($output, ['Producto', 'Descripción', 'Precio', 'Costo', 'Existencia', 'CostoTotal']);

$sql = "SELECT * FROM productos";
$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sumaCostoTotal = 0;
foreach ($productos as $producto) {
    $costoTotal = $producto['Costo'] * $producto['Existencia'];
    $sumaCostoTotal += $costoTotal;

    fputcsv($output, [
        $producto['Producto'],
        $producto['Descripcion'],
        number_format($producto['Precio'], 2),
        number_format($producto['Costo'], 2),
        $producto['Existencia'],
        number_format($costoTotal, 2)
    ]);
}

// Fila de suma total (puedes dejar vacíos algunos campos para que quede claro)
fputcsv($output, ['', '', '', '', 'SUMA CostoTotal', number_format($sumaCostoTotal, 2)]);

fclose($output);
exit;
?>