<?php
include '../backend/config/connection.php';

try {
    // Consultar productos con sus relaciones de marca, categoría y género
    $stmt = $pdo->query("
        SELECT p.id, p.titulo, p.precio, p.precio_original, p.calificacion, p.imagen_url, 
               c.nombre AS categoria, g.nombre AS genero, m.nombre AS marca
        FROM productos p
        LEFT JOIN categorias c ON p.categoria_id = c.id
        LEFT JOIN generos g ON p.genero_id = g.id
        LEFT JOIN marcas m ON p.marca_id = m.id
    ");

    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los productos en formato JSON
    echo json_encode($productos);
} catch (PDOException $e) {
    echo "Error al obtener los productos: " . $e->getMessage();
}
