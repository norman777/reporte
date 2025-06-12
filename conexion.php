<?php
$host = "localhost";
$dbname = "prueba_tecnica";
$user = "root";
$pass = ""; // Pon tu contraseña si tienes

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>