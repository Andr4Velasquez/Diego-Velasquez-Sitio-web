<?php
session_start();
include_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contraseña'];

    // Uso de declaraciones preparadas para evitar inyección SQL
    $stmt = $conexion->prepare("SELECT * FROM usuario WHERE usuario = ? AND contraseña = ?");
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['contraseña'] = $contrasena;
        header("Location: index.html");
        exit();
    } else {
        $error = "Usuario o Contraseña incorrecta";
    }

    $stmt->close();
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Iniciar Sesión</header>
            </div>

            <form action="" method="post">
                <div class="input-field">
                    <input type="text" class="input" placeholder="Usuario" name="usuario" id="usuario" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-field">
                    <input type="password" class="input" placeholder="Contraseña" name="contraseña" id="contraseña" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-field">
                    <input type="submit" class="submit" value="Inicio">
                </div>
            </form>

            <div class="bottom">
                <div class="left">
                    <label><a href="registro.php">Registrarte</a></label>
                </div>
                <div class="right">
                    <label><a href="contraseña.php">¿Olvidaste la contraseña?</a></label>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
