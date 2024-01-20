<?php
include '../config/database.php';

// Verificar si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    // Redirigir a la página de usuarios si la solicitud no es de tipo POST
    header("location: agendar.php");
    exit;
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$barbero = $_POST['barbero'];
$servicio = $_POST['servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$precio = $_POST['precio'];

// Obtener el valor actual de "todas" de la tabla "valores"
$result = mysqli_query($conexion, "SELECT todas FROM valores WHERE id = 1");
$row = mysqli_fetch_assoc($result);
$valor_actual_todas = (int)$row['todas']; // Convertir a entero

// Calcular el nuevo valor de "todas" para la actualización
$nuevo_valor_todas = $valor_actual_todas + 1;

// Consulta de inserción en la tabla "agenda"
$query = "INSERT INTO agenda(barbero, cliente, contacto, correo, fecha_cita, hora_cita, servicio, valor_servicio)
          VALUES('$barbero', '$nombre', '$celular', '$correo', '$fecha', '$hora', '$servicio', '$precio')";

// Consulta de actualización en la tabla "valores"
$actualizacion_todas = "UPDATE valores SET todas = '$nuevo_valor_todas' WHERE id = 1";

// Verificar disponibilidad de la cita
$verificacion_cita = mysqli_query($conexion, "SELECT * FROM agenda WHERE barbero = '$barbero' AND fecha_cita = '$fecha' AND hora_cita = '$hora'");

if (mysqli_num_rows($verificacion_cita) > 0) {
    echo '
        <script>
            alert("Upps, no tenemos agenda disponible para esa fecha u hora. Intenta con otra fecha u hora o selecciona otro barbero.");
            window.location = "agendar.php";
        </script>
    ';
    exit;
}

// Ejecutar consultas
$ejecutar = mysqli_query($conexion, $query);
$ejecutar2 = mysqli_query($conexion, $actualizacion_todas);

// Verificar el éxito de las consultas
if ($ejecutar && $ejecutar2) {
    header("location: ok.php");
    exit;
} else {
    echo '
        <script>
            alert("Registro fallido. Intenta nuevamente o más tarde.");
            window.location = "agendar.php";
        </script>
    ';
    exit;
}

mysqli_close($conexion);
?>
