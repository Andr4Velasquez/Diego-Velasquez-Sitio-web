<?php
// Incluir la conexión a la base de datos
session_start();
include_once 'conexion.php';

// Función para modificar la contraseña de un usuario
function modificarContraseña($email, $nueva_contraseña) {
    global $conexion;

    // Preparar la consulta SQL para actualizar la contraseña del usuario
    $stmt = $conexion->prepare("UPDATE usuario SET contraseña = ? WHERE email = ?");
    $stmt->bind_param("ss", $nueva_contraseña, $email);

    // Ejecutar la consulta
    $resultado = $stmt->execute();
    $stmt->close();

    return $resultado ? true : "Error al modificar la contraseña.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $nueva_contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    // Verificar si las contraseñas coinciden
    if ($nueva_contraseña === $confirmar_contraseña) {
        $resultado = modificarContraseña($email, $nueva_contraseña);

        if ($resultado === true) {
            echo "<script>alert('Contraseña modificada exitosamente.');</script>";
            header("Location: login.php"); // Redirige al usuario al formulario de inicio de sesión
            exit();
        } else {
            echo "<script>alert('" . $resultado . "');</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden.');</script>";
    }
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Contraseña</title>
    <link rel="stylesheet" href="css/contraseña.css">
</head>
<body>
    <div class="box">
        <div class="container">
            <div class="top-header">
                <header>Modificar Contraseña</header>
            </div>

            <form action="" method="post">
                <div class="input-field">
                    <input type="email" class="input" placeholder="Correo Electrónico" name="email" id="email" required>
                    <i class="bx bx-user"></i>
                </div>

                <div class="input-field">
                    <input type="password" class="input" placeholder="Nueva Contraseña" name="contraseña" id="contraseña" required>
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-field">
                    <input type="password" class="input" placeholder="Confirmar Contraseña" name="confirmar_contraseña" id="confirmar_contraseña" required>
                    <i class="bx bx-lock-alt"></i>
                </div>

                <div class="input-field">
                    <input type="submit" class="submit" value="Modificar Contraseña">
                </div>

                <div class="bottom">
                    <div class="left">
                        <label><a href="login.php">Iniciar Sesión</a></label>
                    </div>
                    <div class="right">
                        <label><a href="registro.php">Registrarte</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

