<?php
require_once 'backend/config/connection.php';

// Obtener categorías
$categoriaQuery = "SELECT id, nombre FROM categorias";
$categoriaStmt = $pdo->query($categoriaQuery);
$categorias = $categoriaStmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener géneros
$generoQuery = "SELECT id, nombre FROM generos";
$generoStmt = $pdo->query($generoQuery);
$generos = $generoStmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener marcas
$marcaQuery = "SELECT id, nombre FROM marcas";
$marcaStmt = $pdo->query($marcaQuery);
$marcas = $marcaStmt->fetchAll(PDO::FETCH_ASSOC);

// Filtrado de productos
$filterQuery = "";

if (isset($_GET['categoria']) || isset($_GET['genero']) || isset($_GET['marca'])) {
    $filterConditions = [];

    if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
        $categorias = implode(",", array_map('intval', $_GET['categoria']));
        $filterConditions[] = "productos.categoria_id IN ($categorias)";
    }
    if (isset($_GET['genero']) && !empty($_GET['genero'])) {
        $generos = implode(",", array_map('intval', $_GET['genero']));
        $filterConditions[] = "productos.genero_id IN ($generos)";
    }
    if (isset($_GET['marca']) && !empty($_GET['marca'])) {
        $marcas = implode(",", array_map('intval', $_GET['marca']));
        $filterConditions[] = "productos.marca_id IN ($marcas)";
    }

    if (count($filterConditions) > 0) {
        $filterQuery = "WHERE " . implode(" AND ", $filterConditions);
    }
}

$query = "SELECT productos.id, productos.titulo, productos.precio, productos.precio_original, productos.calificacion, productos.imagen_url AS thumbnail,
                 categorias.nombre AS categoria, generos.nombre AS genero, marcas.nombre AS marca
          FROM productos
          INNER JOIN categorias ON productos.categoria_id = categorias.id
          INNER JOIN generos ON productos.genero_id = generos.id
          INNER JOIN marcas ON productos.marca_id = marcas.id
          $filterQuery";
$stmt = $pdo->query($query);
$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakersEC</title>
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="img/favicon/image.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container-fluid py-4" id="tienda">
        <div class="row">
            <div class="col-2 col-sm-3 col-md-2 slide-in">
                <div class="container-fluid container">
                    <!-- Formulario de filtros dinámicos -->
                    <form id="filters-form" class="py-1">

                        <!-- Filtro de Categorías -->
                        <div class="form-group">
                            <h5 class="font-weight-bold">Categorías</h5>
                            <?php foreach ($categorias as $categoria): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="categoria[]" value="<?= htmlspecialchars($categoria['id']) ?>"
                                        <?= (isset($_GET['categoria']) && in_array($categoria['id'], $_GET['categoria'])) ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= htmlspecialchars($categoria['nombre']) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Filtro de Géneros -->
                        <div class="form-group">
                            <h5 class="font-weight-bold">Géneros</h5>
                            <?php foreach ($generos as $genero): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="genero[]" value="<?= htmlspecialchars($genero['id']) ?>"
                                        <?= (isset($_GET['genero']) && in_array($genero['id'], $_GET['genero'])) ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= htmlspecialchars($genero['nombre']) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Filtro de Marcas -->
                        <div class="form-group">
                            <h5 class="font-weight-bold">Marcas</h5>
                            <?php foreach ($marcas as $marca): ?>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="marca[]" value="<?= htmlspecialchars($marca['id']) ?>"
                                        <?= (isset($_GET['marca']) && in_array($marca['id'], $_GET['marca'])) ? 'checked' : '' ?>>
                                    <label class="form-check-label"><?= htmlspecialchars($marca['nombre']) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </form>
                </div>
            </div>
            <div class="col-10 col-sm-9 col-md-10">
                <div class="container-fluid">
                    <div class="card-body">
                        <div class="row fade-in" id="display-items-div">
                            <?php foreach ($productos as $producto): ?>
                                <?php
                                $descuento = round((($producto['precio_original'] - $producto['precio']) / $producto['precio_original']) * 100);
                                $estrellas = str_repeat('<span class="fa fa-star checked"></span>', $producto['calificacion']) .
                                    str_repeat('<span class="fa fa-star"></span>', 5 - $producto['calificacion']);
                                ?>
                                <div class="col-12 col-md-4 mb-4">
                                    <div class="card" style="height: 100%;">
                                        <img src="<?= htmlspecialchars($producto['thumbnail']) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($producto['titulo']) ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($producto['titulo']) ?></h5>
                                            <div class="card-text"><?= $estrellas ?></div>
                                            <p class="card-text">
                                                <span class="font-weight-bold">$<?= number_format($producto['precio'], 2) ?></span>
                                                <span class="text-muted" style="text-decoration: line-through;">$<?= number_format($producto['precio_original'], 2) ?></span>
                                                <span class="text-danger">(<?= $descuento ?>% off)</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <hr class="fade-in">
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="js/navbar-es.js"></script>
    <script src="https://kit.fontawesome.com/91728c998d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Script para manejar los filtros con AJAX -->
    <script>
        $(document).ready(function() {
            $('#filters-form input[type="checkbox"]').change(function() {
                $.ajax({
                    url: 'tienda.php',
                    type: 'GET',
                    data: $('#filters-form').serialize(),
                    success: function(response) {
                        $('#display-items-div').html($(response).find('#display-items-div').html());
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".fade-in").each(function(i) {
                var element = $(this);
                setTimeout(function() {
                    element.addClass("visible");
                }, 200 * i);
            });

            $(".slide-in").addClass("visible");
        });
    </script>
</body>

</html>