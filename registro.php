<?php
// Incluir la conexión a la base de datos
session_start();
include_once 'conexion.php';

// Función para registrar un usuario
function registrarUsuario($nombre, $usuario, $email, $contrasena) {
    global $conexion;

    // Verificar si el correo ya existe en la base de datos
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $stmt->close();
        return "El correo electrónico ya está registrado.";
    }

    // Preparar la consulta SQL para insertar un nuevo usuario
    $stmt = $conexion->prepare("INSERT INTO usuario (nombre, usuario, email, contraseña) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $usuario, $email, $contrasena);

    // Ejecutar la consulta
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado ? true : "Error al registrar el usuario.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $contrasena = $_POST['contraseña'];

    $resultado = registrarUsuario($nombre, $usuario, $email, $contrasena);

    if ($resultado === true) {
        echo "<script>alert('Usuario registrado exitosamente.');</script>";
        header("Location: login.php"); // Redirige al usuario al formulario de inicio de sesión
        exit();
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
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Registro</header>
            </div>

            <form action="" method="post">
                <div class="input-field">
                    <input type="text" class="input" placeholder="Nombre Completo" name="nombre" id="nombre" required>
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-field">
                    <input type="text" class="input" placeholder="Usuario" name="usuario" id="usuario" required>
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-field">
                    <input type="email" class="input" placeholder="Correo Electrónico" name="email" id="email" required>
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-field">
                    <input type="password" class="input" placeholder="Contraseña" name="contraseña" id="contraseña" required>
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-field">
                    <input type="submit" class="submit" value="Registrar">
                </div>

                <div class="bottom">
                    <div class="left">
                        <label><a href="login.php">Iniciar Sesión</a></label>
                    </div>
                    <div class="right">
                        <label><a href="contraseña.php">¿Olvidaste la contraseña?</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
