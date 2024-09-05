<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-sm navbar-light fade-in">
    <div class="container">
        <img src="img/logo.png" alt="" width="100px">
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mx-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tienda.php">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="soporte.php">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="carrito.php"><i class="fa-solid fa-cart-shopping"></i></a>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Usuario autenticado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="perfil-usuario.php">Perfil</a>
                            <a class="dropdown-item" href="backend/logout.php">Cerrar Sesión</a>
                        </div>
                    </li>
                <?php else: ?>
                    <!-- Usuario no autenticado -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="login.php">Login</a>
                            <a class="dropdown-item" href="registro.php">Register</a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        // Agregar la clase visible para los elementos con la clase fade-in
        $(".navbar-fade-in").each(function(i) {
            var element = $(this);
            setTimeout(function() {
                element.addClass("visible");
            }, 200 * i); // Retraso escalonado para cada elemento
        });
    });
</script>