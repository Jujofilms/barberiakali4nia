<?php
include '../../../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Redirigir a la página de usuarios si la solicitud no es de tipo POST
    header("location: ../servicios.php");
    exit;
}

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];

// Procesar la carga de la imagen
if (!empty($_FILES['imagen']['tmp_name'])) {
    $imagen = $_FILES['imagen']['tmp_name'];
    $imagen_contenido = addslashes(file_get_contents($imagen)); // Convierte la imagen a datos binarios
} else {
    $imagen_contenido = null; // Sin imagen
}

$query = "INSERT INTO servicios(imagen, nombre, descripcion, precio)
          VALUES('$imagen_contenido', '$nombre', '$descripcion', '$precio')";

$verificacion_correo = mysqli_query($conexion, "SELECT * FROM servicios WHERE nombre='$nombre' "); //verificación de correo

if (mysqli_num_rows($verificacion_correo) > 0) { //hace la función de verificación de correo con la db
    echo '
        <script>
            alert("El servicio ya existe. Intente con otro diferente❌");
            window.location = "servicios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion); //cerramos la conexión si esta función se cumple
}

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    header("location: ../../servicios.php");
} else {
    echo '
        <script>
            alert("El registro del servicio no sali bien.");
            window.location = "servicios.php";
        </script>
    '; //si nada se cumple, entonces no se registra
}

mysqli_close($conexion);

// Código hecho por Juan José Molina de (JUJOFILMS STUDIOS CC)
?>
