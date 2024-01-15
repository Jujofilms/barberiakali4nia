<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la fecha seleccionada por el usuario
    $selectedDate = $_POST["fecha"];

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

    // Consulta para obtener el valor de disponibilidad en la agenda para la fecha seleccionada
    $sql = "SELECT disponibilidad FROM agenda1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Obtener el valor actual de disponibilidad
        $row = $result->fetch_assoc();
        $currentAvailability = $row["disponibilidad"];

        // Mostrar el valor actual de disponibilidad
        echo "<h2>Disponibilidad actual para el $selectedDate:</h2>";
        echo "<p>$currentAvailability</p>";

        // Calcular y mostrar el próximo horario disponible (sumando 1 hora)
        $nextAvailability = date('H:i', strtotime($currentAvailability . ' +1 hour'));
        echo "<h3>Próximo horario disponible:</h3>";
        echo "<p>$nextAvailability</p>";

        // Actualizar el valor de disponibilidad en la base de datos
        $sqlUpdate = "UPDATE agenda1 SET disponibilidad = '$nextAvailability'";
        if ($conn->query($sqlUpdate) === TRUE) {
            echo "<p>Disponibilidad actualizada correctamente.</p>";
        } else {
            echo "<p>Error al actualizar la disponibilidad: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>No hay resultados disponibles en la agenda para el $selectedDate.</p>";
    }

    // Cerrar la conexión
    $conn->close();
}
?>