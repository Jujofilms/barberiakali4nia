<?php
session_start();
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password']) && isset($_GET['token'])) {
    $token = $_GET['token'];
    $nueva_contraseña = $_POST['password'];

    $sql_update = $conexion->prepare("UPDATE barbero SET contrasena = ? WHERE token = ?");
    if ($sql_update) {
        $sql_update->bind_param("ss", password_hash($nueva_contraseña, PASSWORD_DEFAULT), $token);
        if ($sql_update->execute()) {
            // Redirige después de actualizar la contraseña
            header("location: login.php");
            exit;
        } else {
            echo "Error al actualizar la contraseña.";
        }
    } else {
        echo "Error en la consulta preparada.";
    }
}
?>
