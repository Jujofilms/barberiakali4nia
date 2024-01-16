<?php
session_start();

if (!isset($_SESSION['ingreso_admin'])) {
    echo '
        <script>
            alert("Por favor debes iniciar sesión para acceder");
            window.location = "../../../../index.php";
        </script>
    ';
    session_destroy();
    die();
}

require '../../../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // Definir $stmt fuera del bloque condicional
    $stmt = null;

    // Manejar la imagen
    if ($_FILES['imagen']['error'] == 0) {
        $imagenTmp = $_FILES['imagen']['tmp_name'];
        $imagenData = file_get_contents($imagenTmp);

        // Actualizar la base de datos con los datos del formulario y la nueva imagen
        $sqlActualizar = "UPDATE servicios 
                          SET nombre = ?, 
                              descripcion = ?, 
                              precio = ?, 
                              imagen = ? 
                          WHERE id = ?";

        $stmt = $conexion->prepare($sqlActualizar);
        $stmt->bind_param('ssisi', $nombre, $descripcion, $precio, $imagenData, $id);
        $stmt->execute();
    } else {
        // Actualizar la base de datos con los datos del formulario sin cambiar la imagen
        $sqlActualizar = "UPDATE servicios 
                          SET nombre = ?, 
                              descripcion = ?, 
                              precio = ?,
                          WHERE id = ?";

        $stmt = $conexion->prepare($sqlActualizar);
        $stmt->bind_param('ssii', $nombre, $descripcion, $precio, $id);
        $stmt->execute();
    }

    if ($stmt && $stmt->affected_rows > 0) {
        echo '<script>alert("Datos actualizados exitosamente, te redirigimos a tu panel"); window.location = "../../servicios.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error al actualizar datos ' . $conexion->error . '"); window.location = "../../servicios.php";</script>';
        exit();
    }

    // Cerrar $stmt solo si está definido
    if ($stmt) {
        $stmt->close();
    }

    $conexion->close();
}
?>
