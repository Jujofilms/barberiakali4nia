<?php
session_start();

if(!isset($_SESSION['ingreso_admin'])) {
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
    $correo = $_POST['correo'];
    $barbero = $_POST['barbero'];
    $administrador = $_POST['administrador'];
    $bloqueo = $_POST['bloqueo'];
    // Asegurar la seguridad de los datos si es necesario (por ejemplo, validar la contraseña)
    
    // Actualizar la base de datos con los datos del formulario
    $sqlActualizar = "UPDATE barbero 
                      SET nombre = '$nombre', 
                          correo = '$correo', 
                          barbero = '$barbero', 
                          administrador = '$administrador', 
                          bloqueo = '$bloqueo' 
                      WHERE id = '$id'";
    
    if ($conexion->query($sqlActualizar) === TRUE) {
        echo '<script>alert("Datos actualizados exitosamente, te redirigimos a tu panel"); window.location = "../../usuarios.php";</script>';
        exit();
    } else {
        echo '<script>alert("Error al actualizar datos ' . $conexion->error . '"); window.location = "movimientos.php";</script>';
            exit();
    }
}
?>
