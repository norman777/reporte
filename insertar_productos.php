<?php
$host = "localhost";
$dbname = "prueba_tecnica";
$user = "root";
$pass = ""; // Si tienes contraseña, colócala aquí

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for ($i = 1; $i <= 100; $i++) {
        $descripcion = "Producto $i";
        $costo = rand(5, 100) + (rand(0, 99) / 100); // Ej: 42.78
        $precio = $costo + rand(5, 50);             // Precio > costo
        $existencia = rand(0, 500);

        $sql = "INSERT INTO productos (Descripcion, Costo, Precio, Existencia)
                VALUES (:descripcion, :costo, :precio, :existencia)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':descripcion' => $descripcion,
            ':costo' => $costo,
            ':precio' => $precio,
            ':existencia' => $existencia
        ]);
    }

    echo "✅ ¡100 productos generados e insertados correctamente!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>