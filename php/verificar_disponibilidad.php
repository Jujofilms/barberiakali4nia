<?php
// Configuración de la base de datos (reemplaza con tus propios datos)
include_once('../config/database.php');

// Parámetros de la solicitud GET
$barbero = $_GET['barbero'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar disponibilidad en la base de datos
$sql = "SELECT * FROM agenda WHERE barbero = '$barbero' AND fecha_cita = '$fecha' AND hora_cita = '$hora'";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Hay resultados, indica que no hay disponibilidad
    $response = array('disponible' => false);
} else {
    // No hay resultados, indica que hay disponibilidad
    $response = array('disponible' => true);
}

// Cerrar conexión
$conn->close();

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
