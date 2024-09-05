<?php

require 'backend/config/connection.php';

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: perfil-usuario.php');
    exit();
}

// Verificar si los datos fueron enviados por el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($email) && !empty($password)) {
        // Preparar la consulta
        $sql = 'SELECT id, username, password FROM usuarios WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si se encontró el usuario y la contraseña es correcta
        if ($user && md5($password, $user['password'])) {
            // Iniciar sesión exitosa: almacenar la información en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirigir al perfil del usuario
            header('Location: perfil-usuario.php');
            exit();
        } else {
            // Si los datos no son correctos, mostrar un mensaje de error
            $error = 'Correo o contraseña incorrectos.';
        }
    } else {
        $error = 'Por favor, complete todos los campos.';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SneakersEC - Iniciar Sesión</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <!-- NAVBAR -->
    <!-- <div id="navbar"></div> -->
    <?php include 'navbar.php'; ?>

    <div class="content d-flex align-items-center justify-content-center content-register">
        <div class="register-container">
            <h2><span>Iniciar Sesión</span><span>SneakerEC</span></h2>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-dark btn-block">Iniciar Sesión</button>
            </form>
            <div class="text-center mt-3">
                <a href="registro.html">¿No tienes cuenta? Crea una</a>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="js/navbar-es.js"></script>
    <script src="https://kit.fontawesome.com/91728c998d.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/acordeon.js"></script>
    <script src="js/scripts.js"></script>

</body>

</html>