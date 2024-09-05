<?php
// filtro.php

// Incluye la conexión a la base de datos
require_once '../backend/config/connection.php';

// Recupera los parámetros de filtro
$categoria_ids = isset($_GET['categoria']) ? $_GET['categoria'] : [];
$genero_ids = isset($_GET['genero']) ? $_GET['genero'] : [];
$marca_ids = isset($_GET['marca']) ? $_GET['marca'] : [];

// Comienza a construir la consulta SQL
$sql = "SELECT p.id, p.titulo, p.precio, p.precio_original, p.calificacion, p.imagen_url, c.nombre as categoria, g.nombre as genero, m.nombre as marca
        FROM productos p
        JOIN categorias c ON p.categoria_id = c.id
        JOIN generos g ON p.genero_id = g.id
        JOIN marcas m ON p.marca_id = m.id
        WHERE 1=1";

// Añade las condiciones para los filtros
$params = [];
if (!empty($categoria_ids)) {
    $sql .= " AND p.categoria_id IN (" . implode(',', array_fill(0, count($categoria_ids), '?')) . ")";
    $params = array_merge($params, $categoria_ids);
}
if (!empty($genero_ids)) {
    $sql .= " AND p.genero_id IN (" . implode(',', array_fill(0, count($genero_ids), '?')) . ")";
    $params = array_merge($params, $genero_ids);
}
if (!empty($marca_ids)) {
    $sql .= " AND p.marca_id IN (" . implode(',', array_fill(0, count($marca_ids), '?')) . ")";
    $params = array_merge($params, $marca_ids);
}

// Ejecuta la consulta
$stmt = $pdo->prepare($sql);
$stmt->execute($params);

// Obtiene los resultados
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Envía los resultados en formato JSON
header('Content-Type: application/json');
echo json_encode($productos);
