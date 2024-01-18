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

    // Obtener el valor actual de "barberos" de la tabla "valores"
    $result = mysqli_query($conexion, "SELECT barberos FROM valores WHERE id = '1'");
    $row = mysqli_fetch_assoc($result);
    $valor_actual_barberos = $row['barberos'];

    // Verificar si el valor actual de "barberos" es mayor que 0 antes de restar
    if ($valor_actual_barberos > 0) {
        // Evitar inyección SQL utilizando consultas preparadas
        $query = "DELETE FROM barbero WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Restar 1 al valor de "barberos" en la tabla "valores"
            $nuevo_valor_barberos = $valor_actual_barberos - 1;
            $actualizacion_usuarios = "UPDATE valores SET barberos = '$nuevo_valor_barberos' WHERE id = '1'";
            $ejecutar_actualizacion = mysqli_query($conexion, $actualizacion_usuarios);
        }
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
