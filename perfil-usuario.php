<?php
// Incluir el archivo de conexión
require 'backend/config/connection.php';

session_start(); // Iniciar sesión

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Obtener los datos del usuario
$user_id = $_SESSION['user_id'];
$sql = 'SELECT u.username, u.email, u.phone, u.website, u.about, p.nombre_completo, p.telefono, p.foto_url, p.direccion, p.sobre, p.hobbies 
        FROM usuarios u 
        LEFT JOIN perfiles p ON u.id = p.usuario_id 
        WHERE u.id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo 'Error: Usuario no encontrado.';
    exit();
}

// Obtener insignias recientes del usuario
$sql_badges = 'SELECT b.nombre FROM usuarios_badges ub 
               INNER JOIN badges b ON ub.badge_id = b.id 
               WHERE ub.usuario_id = :id ORDER BY ub.asignado_en DESC LIMIT 5';
$stmt_badges = $pdo->prepare($sql_badges);
$stmt_badges->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt_badges->execute();
$badges = $stmt_badges->fetchAll(PDO::FETCH_ASSOC);

// Obtener actividad reciente del usuario
$sql_actividad = 'SELECT descripcion, fecha FROM actividad_reciente 
                  WHERE usuario_id = :id ORDER BY fecha DESC LIMIT 5';
$stmt_actividad = $pdo->prepare($sql_actividad);
$stmt_actividad->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt_actividad->execute();
$actividad_reciente = $stmt_actividad->fetchAll(PDO::FETCH_ASSOC);

// Obtener pedidos recientes del usuario
$sql_pedidos = 'SELECT id, fecha, estado, total FROM pedidos 
                WHERE usuario_id = :id ORDER BY fecha DESC LIMIT 5';
$stmt_pedidos = $pdo->prepare($sql_pedidos);
$stmt_pedidos->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt_pedidos->execute();
$pedidos = $stmt_pedidos->fetchAll(PDO::FETCH_ASSOC);

// Datos del usuario
$username = htmlspecialchars($user['username']);
$email = htmlspecialchars($user['email']);
$phone = htmlspecialchars($user['phone'] ?? 'No disponible');
$website = htmlspecialchars($user['website'] ?? 'No disponible');
$about = htmlspecialchars($user['about'] ?? 'No disponible');
$nombre_completo = htmlspecialchars($user['nombre_completo'] ?? 'No disponible');
$telefono = htmlspecialchars($user['telefono'] ?? 'No disponible');
$foto_url = htmlspecialchars($user['foto_url'] ?? 'https://bootdey.com/img/Content/avatar/avatar7.png');
$direccion = htmlspecialchars($user['direccion'] ?? 'No disponible');
$sobre = htmlspecialchars($user['sobre'] ?? 'No disponible');
$hobbies = htmlspecialchars($user['hobbies'] ?? 'No disponible');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - SneakersEC</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- NAVBAR -->
    <!-- <div id="navbar"></div> -->
    <?php include 'navbar.php'; ?>

    <div id="user-profile" class="container py-4 fade-in">
        <div class="row">
            <div class="col-lg-4">
                <div class="profile-card-4 z-depth-3">
                    <div class="card">
                        <div class="card-body text-center bg-dark rounded-top">
                            <div class="user-box">
                                <img id="user-avatar" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="user avatar">
                            </div>
                            <h5 id="user-name" class="mb-1 text-white"><?php echo $username; ?></h5>
                            <h6 id="user-title" class="text-light">Sneaker Enthusiast</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group shadow-none">
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-phone-square"></i>
                                    </div>
                                    <div class="list-details">
                                        <span id="user-phone"><?php echo $phone; ?></span>
                                        <small>Mobile Number</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="list-details">
                                        <span id="user-email"><?php echo $email; ?></span>
                                        <small>Email Address</small>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="list-icon">
                                        <i class="fa fa-globe"></i>
                                    </div>
                                    <div class="list-details">
                                        <span id="user-website"><?php echo $website; ?></span>
                                        <small>Website</small>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card z-depth-3">
                    <div class="card-body">
                        <ul class="nav nav-pills nav-pills-primary nav-justified">
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#profile" data-toggle="pill" class="nav-link active show"><i class="icon-user"></i> <span class="hidden-xs">Profile</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#orders" data-toggle="pill" class="nav-link"><i class="icon-envelope-open"></i> <span class="hidden-xs">Orders</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
                            </li>
                        </ul>
                        <div class="tab-content p-3">
                            <div class="tab-pane active show" id="profile">
                                <h5 class="mb-3">User Profile</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>About</h6>
                                        <p><?php echo $about; ?></p>
                                        <h6>Hobbies</h6>
                                        <p>Sneaker collecting, streetwear fashion, and basketball.</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Recent badges</h6>
                                        <?php if (!empty($badges)): ?>
                                            <?php foreach ($badges as $badge): ?>
                                                <a href="javascript:void();" class="badge badge-dark badge-pill"><?php echo htmlspecialchars($badge['nombre']); ?></a>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p>No badges available</p>
                                        <?php endif; ?>
                                        <hr>
                                    </div>

                                    <div class="col-md-12">
                                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                <?php if (!empty($actividad_reciente)): ?>
                                                    <?php foreach ($actividad_reciente as $actividad): ?>
                                                        <tr>
                                                            <td><?php echo htmlspecialchars($actividad['descripcion']); ?> en <strong><?php echo htmlspecialchars($actividad['fecha']); ?></strong></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td>No recent activities</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <!--/row-->
                            </div>
                            <div class="tab-pane" id="orders">
                                <h5 class="mb-3">Recent Orders</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($pedidos)): ?>
                                                <?php foreach ($pedidos as $pedido): ?>
                                                    <?php
                                                    // Asignar clases de Bootstrap basadas en el estado del pedido
                                                    $badgeClass = '';
                                                    switch (strtolower($pedido['estado'])) {
                                                        case 'delivered':
                                                            $badgeClass = 'badge-success';
                                                            break;
                                                        case 'pending':
                                                            $badgeClass = 'badge-warning';
                                                            break;
                                                        case 'cancelled':
                                                            $badgeClass = 'badge-danger';
                                                            break;
                                                        default:
                                                            $badgeClass = 'badge-secondary'; // Clase predeterminada
                                                            break;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td>#<?php echo htmlspecialchars($pedido['id']); ?></td>
                                                        <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                                                        <td><span class="badge <?php echo $badgeClass; ?>"><?php echo htmlspecialchars($pedido['estado']); ?></span></td>
                                                        <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                                                        <td>
                                                            <button class="btn btn-secondary btn-sm">View</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5">No recent orders</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="tab-pane" id="edit">
                                <form>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="<?php echo $username; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="email" value="<?php echo $email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Phone</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="<?php echo $phone; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" value="<?php echo $website; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">About</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" rows="5"><?php echo $about; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-9 offset-lg-3">
                                            <button class="btn btn-primary" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-right">
                    <img src="img/logo.png" alt="" class="img-fluid" width="40%">
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="py-1"><a href="#" class="text-white">Home</a></li>
                        <li class="py-1"><a href="#" class="text-white">Shop</a></li>
                        <li class="py-1"><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center mt-2">
                <p>&copy; 2024 Grupo 3. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="js/navbar-es.js"></script>
    <script src="https://kit.fontawesome.com/91728c998d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/acordeon.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>