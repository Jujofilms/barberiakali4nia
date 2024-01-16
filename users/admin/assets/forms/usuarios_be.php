<?php
include '../../../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Redirigir a la página de usuarios si la solicitud no es de tipo POST
    header("location: ../usuarios.php");
    exit;
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$barbero = isset($_POST['barber']) ? 1 : 0;
$administrador = isset($_POST['administrador']) ? 1 : 0;

// Procesar la carga de la imagen
if (!empty($_FILES['imagen']['tmp_name'])) {
    $imagen = $_FILES['imagen']['tmp_name'];
    $imagen_contenido = addslashes(file_get_contents($imagen)); // Convierte la imagen a datos binarios
} else {
    $imagen_contenido = null; // Sin imagen
}

$query = "INSERT INTO barbero(nombre, correo, contrasena, barbero, administrador, bloqueo, token, imagen)
          VALUES('$nombre', '$correo', '$contrasena', '$barbero', '$administrador', '0', '0', '$imagen_contenido')";

$verificacion_correo = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo' "); //verificación de correo

if (mysqli_num_rows($verificacion_correo) > 0) { //hace la función de verificación de correo con la db
    echo '
        <script>
            alert("La dirección de correo electrónico ya existe. Intente con otro diferente❌");
            window.location = "usuarios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion); //cerramos la conexión si esta función se cumple
}

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    header("location: ../../usuarios.php");
} else {
    echo '
        <script>
            alert("Registro fallido. Intente nuevamente o más tarde");
            window.location = "login.php";
        </script>
    '; //si nada se cumple, entonces no se registra
}

mysqli_close($conexion);

// Código hecho por Juan José Molina de (JUJOFILMS STUDIOS CC)
?>
