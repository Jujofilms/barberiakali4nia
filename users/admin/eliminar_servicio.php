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

    // Obtener el valor actual de "servicios" de la tabla "valores"
    $result = mysqli_query($conexion, "SELECT servicios FROM valores WHERE id = '1'");
    $row = mysqli_fetch_assoc($result);
    $valor_actual_servicios = $row['servicios'];

    // Verificar si el valor actual de "servicios" es mayor que 0 antes de restar
    if ($valor_actual_servicios > 0) {
        // Evitar inyección SQL utilizando consultas preparadas
        $query = "DELETE FROM servicios WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Restar 1 al valor de "servicios" en la tabla "valores"
            $nuevo_valor_servicios = $valor_actual_servicios - 1;
            $actualizacion_servicios = "UPDATE valores SET servicios = '$nuevo_valor_servicios' WHERE id = '1'";
            $ejecutar_actualizacion = mysqli_query($conexion, $actualizacion_servicios);
        }
    }

    // Redirigir de nuevo a la página de servicios después de eliminar
    header("location: servicios.php");
    exit;
} else {
    // Si no se proporciona un ID, redirigir a la página de servicios
    header("location: servicios.php");
    exit;
}
?>

