<?php
// Incluir la conexión a la base de datos
session_start();
include_once 'conexion.php';

// Función para registrar un usuario
function registrarUsuario($nombre, $email, $opinion) {
    global $conexion;

    // Verificar si el correo ya existe en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM opinion WHERE email = ?");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $stmt->close();
        return "El correo electrónico ya está registrado.";
    }

    // Preparar la consulta SQL para insertar un nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO opinion (nombre, email, opinion) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }
    $stmt->bind_param("sss", $nombre, $email, $opinion);

    // Ejecutar la consulta
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado ? true : "Error al registrar el usuario: " . $conexion->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $opinion = $_POST['opinion'];

    $resultado = registrarUsuario($nombre, $email, $opinion);

    if ($resultado === true) {
        echo "<script>alert('Usuario registrado exitosamente.');</script>";
    } else {
        echo "<script>alert('" . $resultado . "');</script>";
    }
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contacto.css">
    <!-- Iconos -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Contacto</title>
</head>
<body>

<header class="header">
    <a href="#home" class="logo">Zona
        <span>Arcade</span>
        <i class='bx bx-menu' id="menu-icon"></i>
    </a>
    <nav class="navbar">
        <a href="index.html">Inicio</a>
        <a href="generos.html">Géneros</a>
        <a href="productos.html">Productos</a>
        <a href="acerca.html">Acerca De</a>
        <a href="contactos.php" class="active">Contactos</a>
        <a href="login.php">Cerrar Sesión</a>
    </nav>
</header>

<section class="contact" id="contact">
    <h2>Contacto</h2>

    <!-- Mensaje de éxito o error -->
    <?php if (isset($message)) : ?>
        <div class="message">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <!-- Formulario de contacto -->
    <div class="contact-form">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="name">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Da tu opinión sobre la página:</label>
            <textarea id="opinion" name="opinion" rows="5" required></textarea>

            <button type="submit" class="btn">Enviar Mensaje</button>
        </form>
    </div>

    <!-- Enlaces a redes sociales -->
    <div class="social-icons">
        <a href="https://github.com"><i class='bx bxl-github'></i></a>
        <a href="https://www.instagram.com"><i class='bx bxl-instagram-alt'></i></a>
        <a href="https://x.com/home"><i class='bx bxl-twitter'></i></a>
    </div>
</section>

<footer style="background-color: #1a1a1a; color: white; padding: 20px 0; text-align: center;">
    <div class="container">
        <h3>Zona Arcade</h3>
        <p>Síguenos en nuestras redes sociales o contáctanos para más información.</p>

        <div class="social-icons" style="margin: 20px 0;">
            <a href="#" style="margin: 0 10px; color: white; font-size: 24px;"><i class='bx bxl-linkedin'></i></a>
            <a href="#" style="margin: 0 10px; color: white; font-size: 24px;"><i class='bx bxl-github'></i></a>
            <a href="#" style="margin: 0 10px; color: white; font-size: 24px;"><i class='bx bxl-instagram-alt'></i></a>
            <a href="#" style="margin: 0 10px; color: white; font-size: 24px;"><i class='bx bxl-twitter'></i></a>
        </div>

        <div class="footer-bottom" style="margin-top: 20px; border-top: 1px solid #333; padding-top: 10px;">
            <p>&copy; 2024 Zona Arcade. Todos los derechos reservados.</p>
        </div>
    </div>
</foot
