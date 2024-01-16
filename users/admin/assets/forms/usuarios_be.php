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
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombre_imagen = $_FILES['imagen']['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamano_imagen = $_FILES['imagen']['size'];
    $imagen_temporal = $_FILES['imagen']['tmp_name'];

    // Verificar que el archivo sea una imagen
    $allowed_types = array('image/jpeg', 'image/png', 'image/gif');
    if (in_array($tipo_imagen, $allowed_types)) {
        // Mover la imagen al directorio deseado
        $directorio_destino = '../../../../img/usuario_img/';
        $ruta_imagen = $directorio_destino . $nombre_imagen;
        move_uploaded_file($imagen_temporal, $ruta_imagen);
    } else {
        // Manejar error si el tipo de imagen no es permitido
        echo '
            <script>
                alert("Tipo de imagen no permitido. Suba una imagen JPEG, PNG o GIF.");
                window.location = "../usuarios.php";
            </script>
        ';
        exit;
    }
}

$query = "INSERT INTO barbero(nombre, correo, contrasena, barbero, administrador, bloqueo, token, imagen)
          VALUES('$nombre', '$correo', '$contrasena', '$barbero', '$administrador', '0', '0', '$ruta_imagen')";

$verificación_correo = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo' "); //verificación de correo

if (mysqli_num_rows($verificación_correo) > 0) { //hace la funcion de verificación de correo con la db
    echo '
        <script>
            alert("La dirección de correo electrónico ya existe intente con otro diferente❌");
            window.location = "usuarios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion); //cerramos la conexion si esta funcio se cumple
}

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    header("location: ../../usuarios.php");
} else {
    echo '
        <script>
            alert("Registro fallido intente nuevamente o más tarde");
            windows.location = "login.php";
        </script>
    '; //si nada se cumplio entonces no se registra
}

mysqli_close($conexion);

//codigo hecho por JUAN JOSE MOLINA DE (JUJOFILMS STUDIOS CC) 

?>