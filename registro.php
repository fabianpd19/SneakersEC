<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="img/favicon/image.png" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>

    <!-- NAVBAR -->
    <?php include 'navbar.php'; ?>

    <div class="content d-flex align-items-center justify-content-center content-register">
        <div class="register-container">
            <h2 class="text-center">Registrar Usuario SneakEC</h2>
            <button class="btn btn-outline-primary btn-block mb-3" disabled>Registrar con Google</button>

            <!-- Mensaje de error o éxito -->
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo htmlspecialchars($_GET['success']); ?>
                </div>
            <?php endif; ?>

            <form action="backend/register.php" method="post">
                <div class="form-group">
                    <label for="fullname">Nombre Completo</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nombre Completo"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <label for="website">Sitio Web</label>
                    <input type="text" class="form-control" id="website" name="website" placeholder="Sitio Web"
                        required>
                </div>
                <div class="form-group">
                    <label for="about">Acerca de</label>
                    <textarea class="form-control" id="about" name="about" placeholder="Sobre ti" rows="3"
                        required></textarea>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                        required>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirm-password" name="confirm_password"
                        placeholder="Confirmar Contraseña" required>
                </div>
                <?php
                if (isset($_SESSION['alertMessage'])) {
                    echo $_SESSION['alertMessage'];
                    unset($_SESSION['alertMessage']); // Limpiar el mensaje después de mostrarlo
                }
                ?>
                <button type="submit" class="btn btn-dark btn-block">Registrar</button>
            </form>
            <div class="text-center mt-3">
                <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
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