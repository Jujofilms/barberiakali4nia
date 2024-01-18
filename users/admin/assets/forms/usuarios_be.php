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
$id = 1;

// Procesar la carga de la imagen
if (!empty($_FILES['imagen']['tmp_name'])) {
    $imagen = $_FILES['imagen']['tmp_name'];
    $imagen_contenido = addslashes(file_get_contents($imagen)); // Convierte la imagen a datos binarios
} else {
    $imagen_contenido = null; // Sin imagen
}

// Obtener el valor actual de "barberos" de la tabla "valores"
$result = mysqli_query($conexion, "SELECT barberos FROM valores WHERE id = '$id'");
$row = mysqli_fetch_assoc($result);
$valor_actual_barberos = $row['barberos'];

// Calcular el nuevo valor de "barberos" para la actualización
$nuevo_valor_barberos = $valor_actual_barberos + 1;

// Consulta de inserción en la tabla "barbero"
$query = "INSERT INTO barbero(nombre, correo, contrasena, barbero, administrador, bloqueo, token, imagen)
          VALUES('$nombre', '$correo', '$contrasena', '$barbero', '$administrador', '0', '0', '$imagen_contenido')";

// Consulta de actualización en la tabla "valores"
$actualizacion_usuarios = "UPDATE valores SET barberos = '$nuevo_valor_barberos' WHERE id = '$id'";

// Verificación de correo
$verificacion_correo = mysqli_query($conexion, "SELECT * FROM barbero WHERE correo='$correo' ");

if (mysqli_num_rows($verificacion_correo) > 0) {
    echo '
        <script>
            alert("La dirección de correo electrónico ya existe. Intente con otro diferente❌");
            window.location = "usuarios.php";
        </script>
    ';
    exit;
    mysqli_close($conexion);
}

// Ejecutar consultas
$ejecutar = mysqli_query($conexion, $query);
$ejecutar2 = mysqli_query($conexion, $actualizacion_usuarios);

if ($ejecutar && $ejecutar2) {
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
?>
