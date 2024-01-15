<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["continuar"])) {
    // Obtener la fecha seleccionada y actualizar la disponibilidad
    $selectedDate = $_POST["fecha"];

    // Lógica para actualizar la disponibilidad (ejemplo: sumar 1 hora)
    $newAvailability = date('H:i', strtotime('+1 hour', strtotime('6:00')));

    // Establecer la conexión con la base de datos (reemplaza los valores con los de tu configuración)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "barberc_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Actualizar la disponibilidad en la base de datos
    $sqlUpdate = "UPDATE agenda1 SET disponibilidad = '$newAvailability' WHERE fecha = '$selectedDate'";
    if ($conn->query($sqlUpdate) === TRUE) {
        echo "Disponibilidad actualizada correctamente.";
    } else {
        echo "Error al actualizar la disponibilidad: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
