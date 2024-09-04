<?php
// db_connect.php

$host = 'localhost';
$dbname = 'SneakersEC';
$user = 'sneakeradmin';
$password = '123456789';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    // Habilitar el manejo de errores en PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error en la conexión a la base de datos: " . $e->getMessage();
    exit();
}
