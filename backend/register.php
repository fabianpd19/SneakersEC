<?php
// Incluir el archivo de conexión a la base de datos
require('../backend/config/connection.php');
session_start(); // Iniciar sesión para manejar mensajes de alerta

// Inicializar la variable de mensaje de alerta
$_SESSION['alertMessage'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $website = $_POST['website'] ?? '';
    $about = $_POST['about'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validar contraseñas
    if ($password !== $confirm_password) {
        $_SESSION['alertMessage'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                          Las contraseñas no coinciden.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>';
        header('Location: ../registro.php');
        exit();
    }

    // Hashear la contraseña
    $hashed_password = md5($password); // Considera usar bcrypt para mayor seguridad

    try {
        // Insertar datos en la tabla usuarios
        $sql = "INSERT INTO usuarios (username, password, email, phone, website, about) 
                VALUES (:username, :password, :email, :phone, :website, :about) RETURNING id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $fullname,
            ':password' => $hashed_password,
            ':email' => $email,
            ':phone' => $phone,
            ':website' => $website,
            ':about' => $about
        ]);

        // Obtener el ID del usuario recién insertado
        $usuario_id = $stmt->fetchColumn();

        // Insertar datos en la tabla perfiles
        $sql_profile = "INSERT INTO perfiles (usuario_id, nombre_completo, telefono, foto_url, direccion, sobre, hobbies, website) 
                        VALUES (:usuario_id, :nombre_completo, :telefono, :foto_url, :direccion, :sobre, :hobbies, :website)";
        $stmt_profile = $pdo->prepare($sql_profile);
        $stmt_profile->execute([
            ':usuario_id' => $usuario_id,
            ':nombre_completo' => $fullname,
            ':telefono' => $phone,
            ':foto_url' => '',
            ':direccion' => '',
            ':sobre' => $about,
            ':hobbies' => '',
            ':website' => $website
        ]);

        // Mensaje de éxito
        $_SESSION['alertMessage'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                          Registro exitoso. Puedes iniciar sesión ahora.
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>';
        header('Location: ../login.php');
        exit();
    } catch (PDOException $e) {
        // Manejo de errores
        if ($e->getCode() == '23505') { // Código de error para violación de clave única
            $_SESSION['alertMessage'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              El nombre de usuario ya está en uso. Por favor, elige otro.
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>';
        } else {
            $_SESSION['alertMessage'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                              Error: ' . htmlspecialchars($e->getMessage()) . '
                                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>';
        }
        header('Location: ../registro.php');
        exit();
    }
} else {
    // Redirigir si el formulario no fue enviado
    header('Location: ../registro.php');
}
