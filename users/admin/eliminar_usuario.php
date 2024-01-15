<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_admin'])) {
    header("location: ../../index.php");
    exit;
}

// Incluir archivo de configuración de la base de datos
include_once('../../config/database.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Evitar inyección SQL utilizando consultas preparadas
    $query = "DELETE FROM barbero WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Redirigir de nuevo a la página de usuarios después de eliminar
    header("location: usuarios.php");
    exit;
} else {
    // Si no se proporciona un ID, redirigir a la página de usuarios
    header("location: usuarios.php");
    exit;
}
?>
