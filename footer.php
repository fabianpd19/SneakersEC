<?php
// Verifica si la sesión no ha sido iniciada antes de llamar a session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar sesión solo si aún no ha sido iniciada
}
?>

<footer class="bg-dark text-white pt-4 pb-4">
    <div class="container">
        <div class="row">
            <!-- Información de la compañía -->
            <div class="col-md-6 text-right">
                <img src="img/logo.png" alt="" class="img-fluid" width="40%">
                <p class="lead py-2" style="font-size: 15px;">Compra los mejores sneakers.</p>
            </div>

            <div class="col-md-6">
                <h4 class="text-white font-weight-bold">Página</h4>
                <ul class="list-unstyled">
                    <li class="py-1"><a href="index.php" class="text-white">Home</a></li>
                    <li class="py-1"><a href="tienda.php" class="text-white">Shop</a></li>
                    <li class="py-1"><a href="soporte.php" class="text-white">Contact</a></li>
                </ul>
            </div>
            <!-- Redes sociales -->
            <!-- <div class="col-md-4">
                    <h5>Síguenos</h5>
                    <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                </div> -->
        </div>
        <div class="text-center mt-3">
            <p>&copy; 2024 Grupo 3. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>