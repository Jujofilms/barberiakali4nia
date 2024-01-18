<?php
include '../../../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Redirigir a la página de servicios si la solicitud no es de tipo POST
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

// Obtener el valor actual de "servicios" de la tabla "valores"
$result = mysqli_query($conexion, "SELECT servicios FROM valores WHERE id = '1'");
$row = mysqli_fetch_assoc($result);
$valor_actual_servicios = $row['servicios'];

// Calcular el nuevo valor de "servicios" para la actualización
$nuevo_valor_servicios = $valor_actual_servicios + 1;

$query = "INSERT INTO servicios(imagen, nombre, descripcion, precio)
          VALUES('$imagen_contenido', '$nombre', '$descripcion', '$precio')";

$verificacion_servicio = mysqli_query($conexion, "SELECT * FROM servicios WHERE nombre='$nombre' ");

if (mysqli_num_rows($verificacion_servicio) > 0) {
    echo '
        <script>
            alert("El servicio ya existe. Intente con otro diferente❌");
            window.location = "servicios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion);
}

$ejecutar = mysqli_query($conexion, $query);

if ($ejecutar) {
    // Actualizar el valor de "servicios" en la tabla "valores"
    $actualizacion_servicios = "UPDATE valores SET servicios = '$nuevo_valor_servicios' WHERE id = '1'";
    $ejecutar_actualizacion = mysqli_query($conexion, $actualizacion_servicios);

    header("location: ../../servicios.php");
} else {
    echo '
        <script>
            alert("El registro del servicio no salió bien.");
            window.location = "servicios.php";
        </script>
    ';
}

mysqli_close($conexion);
?>
