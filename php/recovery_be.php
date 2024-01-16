<?php
session_start();

include '../config/database.php'; // Incluimos el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Si no se ha enviado un formulario POST, redirigimos a la página de inicio de sesión.
    header("location: recovery.php");
    exit;
}

// Configuración de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../emails/phpmailer/src/Exception.php';
require '../emails/phpmailer/src/PHPMailer.php';
require '../emails/phpmailer/src/SMTP.php';

$correo = $_POST['correo']; // Obtenemos el correo electrónico del formulario

// Obtención del nombre del cliente
$sql = "SELECT nombre FROM barbero WHERE correo='".$correo."'";
$resultado = $conexion->query($sql);
while($data=$resultado->fetch_assoc()){
    $nombre_cliente = $data['nombre'];
}

// Función para generar un token para la recuperación de la contraseña
function generarToken($longitud = 32) {
    if (!isset($longitud) || intval($longitud) <= 8) {
        $longitud = 32;
    }
    return substr(bin2hex(random_bytes(($longitud + 1) / 2)), 0, $longitud);
}

$token = generarToken(); // Genera un token de longitud predeterminada (32 caracteres)

// Preparación para insertar en la tabla los datos del token
$validacion_recuperacion = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo'");

if(mysqli_num_rows($validacion_recuperacion) > 0){
    $sql = $conexion->prepare("UPDATE barbero SET token = ? WHERE correo = ?");
    $sql->execute([$token, $correo]);
    if($sql){
        $mail = new PHPMailer(true);
        try {
            // Configuración del servidor SMTP y envío del correo
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'mail.jujofilms.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'noreply@kali4nia.com';
            $mail->Password   = '@Molina2009';
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Destinatarios y contenido del correo
            $mail->setFrom('noreply@kali4nia.com', 'BARBERIA KALI4NIA');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Recuperacion de usuario - BARBERIA KALI4NIA';
            $mail->Body    = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <link rel="icon" type="image/x-icon" href="../imagenes/logo.png"/>
                    <title>Recuperación De Usuario BARBERIA KALI4NIA</title>
                    <style>
                        /* Estilos de correo electrónico */
                    </style>
                </head>
                <body>
                    <div class="container">
                        <h1>Recuperación de usuario</h1>
                        <p>Estimado(a) usuario ' . $nombre_cliente . ',</p>
                        <p>Para poder recuperar la contraseña de su usuario haga clic en el siguiente enlace:</p>
                        <p><a href="https://kali4nia.com/php/update_password.php?token=' . $token . '">Cambiar Contraseña</a></p>
                        <p>Este enlace es esencial para continuar su recuperación de usuario.</p>
                        <p>Gracias,</p>
                        <p>Equipo de BARBERIA KALI4NIA</p>
                    </div>
                </body>
                </html>
            ';
            
            $mail->setLanguage('es', '../emails/phpmailer/language/phpmailer.lang-es.php');
            $mail->send();
            echo '<script> alert("Link de recuperacion enviado a ' . $correo . '"); window.location.href = "login.php"; </script>';
        } catch (Exception $e) {
            echo "Error al enviar el link de verificación: {$mail->ErrorInfo}";
        }
    }
} else {
    echo '<script> alert("No encontramos ninguna cuenta registrada con ' . $correo . '"); window.location.href = "login.php"; </script>';
}
