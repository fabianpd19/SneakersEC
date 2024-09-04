<?php
// Verifica si la sesión está activa antes de intentar destruirla
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Inicia la sesión solo si no ha sido iniciada
}

// Destruye todas las variables de sesión
$_SESSION = [];

// Destruye la sesión completamente
session_destroy();

// Redirige al usuario a la página de inicio de sesión o a otra página
header("Location: ../login.php");
exit();
