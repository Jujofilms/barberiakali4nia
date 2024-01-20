<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_barbero'])) {
    echo '<script>alert("Debes iniciar sesión para acceder"); window.location = "../../../../index.php";</script>';
    session_destroy();
    die();
}

require '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    // Manejar la imagen
    if ($_FILES['imagen']['error'] == 0) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenData = file_get_contents($imagenTmp);

        // Actualizar la base de datos con los datos del formulario y la nueva imagen
        $sqlActualizar = "UPDATE barbero 
                          SET nombre = '$nombre', 
                              correo = '$correo', 
                              imagen = ? 
                          WHERE id = '$id'";

        $stmt = $conexion->prepare($sqlActualizar);
        $stmt->bind_param('s', $imagenData);
        $stmt->execute();
    } else {
        // Actualizar la base de datos con los datos del formulario sin cambiar la imagen
        $sqlActualizar = "UPDATE barbero 
                          SET nombre = '$nombre', 
                              correo = '$correo' 
                          WHERE id = '$id'";

        $conexion->query($sqlActualizar);
    }

    if ($stmt && $stmt->affected_rows > 0) {
        echo '<script>alert("Datos actualizados exitosamente, te redirigimos a tu panel"); window.location = "index.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error al actualizar datos ' . $conexion->error . '"); window.location = "index.php";</script>';
        exit();
    }

    // Cerrar $stmt solo si está definido
    if ($stmt) {
        $stmt->close();
    }

    $conexion->close();
}
?>
