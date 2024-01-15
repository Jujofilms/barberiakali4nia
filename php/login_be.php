<?php

session_start();

include '../config/database.php'; // Incluimos el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Si no se ha enviado un formulario POST, redirigimos a la página de inicio de sesión.
    header("location: login.php");
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../emails/phpmailer/src/Exception.php';
require '../emails/phpmailer/src/PHPMailer.php';
require '../emails/phpmailer/src/SMTP.php';

$correo = $_POST['correo']; // Obtenemos el correo del formulario
$contrasena = $_POST['contrasena']; // Obtenemos la contraseña del formulario

// Verificación de credenciales en la base de datos
$validacion_login = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo'"); // Validamos los datos en la base de datos

if (mysqli_num_rows($validacion_login) > 0) {
    // Si las credenciales existen en la base de datos
    $fila = mysqli_fetch_assoc($validacion_login);
    $contrasena_hash = $fila['contrasena'];

    // Verificar la contraseña hasheada con password_verify
    if (password_verify($contrasena, $contrasena_hash)) {
        $sql2 = "SELECT nombre, barbero, administrador, bloqueo FROM barbero WHERE correo='" . $correo . "'";
        $resultado2 = $conexion->query($sql2);

        while ($data = $resultado2->fetch_assoc()) {
            $nombre = $data['nombre'];
            $activacion = $data['activacion'];
            $barbero = $data['barbero'];
            $admin = $data['administrador'];
            $bloqueo = $data['bloqueo'];
        }

        if ($barbero == 1) {
            if ($bloqueo == 0) {
                $_SESSION['ingreso_barbero'] = $correo;
                header("location: ../users/barbero/index.php");
            } else {
                mostrarMensajeError("Barbero " . $nombre . " su cuenta ha sido bloqueada por un administrador");
            }
        } elseif ($admin == 1) {
            if ($bloqueo == 0) {
                $_SESSION['ingreso_admin'] = $correo;
                header("location: ../users/admin/index.php");
            } else {
                mostrarMensajeError("Administrador " . $nombre . " su cuenta ha sido bloqueada por el administrador principal");
            }
        } else {
            mostrarMensajeError("Correo o Contraseña son incorrectos❌");
        }
    } else {
        mostrarMensajeError("Correo o Contraseña son incorrectos❌");
    }
} else {
    mostrarMensajeError("Correo o Contraseña son incorrectos❌");
}

function mostrarMensajeError($mensaje)
{
    echo "
        <script>
            alert('$mensaje');
            window.location = 'login.php';
        </script>
    ";
    exit;
}

?>
