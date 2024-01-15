<?php
include '../../../../config/database.php';

// Redirigir a la página de usuarios si la solicitud no es de tipo POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: ../usuarios.php");
    exit;
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
$barbero = isset($_POST['barber']) ? 1 : 0;
$administrador = isset($_POST['administrador']) ? 1 : 0;

// Procesar la carga de la imagen
if ($_POST['imagen'] == 'inserta_archivo') {
    $referencia = uniqid();  
    $titulo = $nombre;

    if (!empty($_FILES['imagen']['tmp_name'])) {
        $archivos = $_FILES['imagen'];
        $numArchivos = count($archivos['tmp_name']);

        $imageBase64 = '';  // Inicializar la variable para concatenar las imágenes

        for ($i = 0; $i < $numArchivos; $i++) {
            $contenidoImagen = file_get_contents($archivos['tmp_name'][$i]);  
            $imagenBase64 = base64_encode($contenidoImagen);
            $imageBase64 .= $imagenBase64;  // Concatenar las imágenes en base64
        }
    }
}

$query = "INSERT INTO barbero(nombre, correo, contrasena, barbero, administrador, bloqueo, token, imagen)
          VALUES('$nombre', '$correo', '$contrasena', '$barbero', '$administrador', '0', '0', '$imageBase64')";

// Verificación de correo
$verificacionCorreo = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo' ");

if (mysqli_num_rows($verificacionCorreo) > 0) {
    echo '
        <script>
            alert("La dirección de correo electrónico ya existe. Intente con otro diferente❌");
            window.location = "usuarios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion);
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
    ';
}

mysqli_close($conexion);
// Código hecho por Juan José Molina de (JUJOFILMS STUDIOS CC)
?>
