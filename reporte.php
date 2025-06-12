<?php
include 'conexion.php';
date_default_timezone_set('America/El_Salvador');

$sql = "SELECT * FROM productos";
$stmt = $pdo->query($sql);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; }
        h2, h4 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #999; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        tfoot td { font-weight: bold; background-color: #e0e0e0; }
    </style>
</head>
<body>
    <h2>Elite Brands SA de CV</h2>
    <h4>Reporte de Costos y Existencias al <?php echo date("d/m/Y"); ?></h4>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Costo</th>
                <th>Existencia</th>
                <th>CostoTotal</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sumaCostoTotal = 0;
            foreach ($productos as $producto) {
                $costoTotal = $producto['Costo'] * $producto['Existencia'];
                $sumaCostoTotal += $costoTotal;
                echo "<tr>
                        <td>{$producto['Producto']}</td>
                        <td>{$producto['Descripcion']}</td>
                        <td>$" . number_format($producto['Precio'], 2) . "</td>
                        <td>$" . number_format($producto['Costo'], 2) . "</td>
                        <td>{$producto['Existencia']}</td>
                        <td>$" . number_format($costoTotal, 2) . "</td>
                      </tr>";
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">SUMA CostoTotal</td>
                <td>$<?php echo number_format($sumaCostoTotal, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    <div style="text-align:center; margin-bottom:20px;">
    <form method="post" action="exportar_excel.php">
        <button type="submit" style="padding:10px 20px; font-size:16px;">Exportar a Excel</button>
    </form>
</div>
</body>
</html>