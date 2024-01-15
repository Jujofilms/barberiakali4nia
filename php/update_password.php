<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET['token'])) {
    header("location: login.php");
    exit;
}

$token = $_GET['token'];

$sql = "SELECT correo FROM barbero WHERE token='".$token."'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Token válido, mostrar formulario para cambiar la contraseña
    include 'update_password_form.php';
} else {
    echo "El token es inválido o ha expirado. Por favor, solicite otro enlace de recuperación de contraseña.";
}
?>
