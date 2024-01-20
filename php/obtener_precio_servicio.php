<?php
// Incluir archivo de configuración de la base de datos
include_once('../config/database.php');

// Verificar si se recibió el parámetro "servicio"
if (isset($_GET['servicio'])) {
    $servicio = mysqli_real_escape_string($conexion, $_GET['servicio']);

    // Consultar la base de datos para obtener el precio del servicio
    $query = "SELECT precio FROM servicios WHERE nombre = '$servicio'";
    $result = mysqli_query($conexion, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $precio = $row['precio'];

        // Formatear el precio con separadores de miles y sin decimales
        echo $precio;
    } else {
        echo 'Error al consultar la base de datos';
    }
} else {
    echo 'Parámetro "servicio" no recibido';
}
?>
