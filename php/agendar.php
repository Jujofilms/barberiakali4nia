<?php
// Iniciar o reanudar la sesión
session_start();

// Incluir archivo de configuración de la base de datos
include_once('../config/database.php');

// Obtener datos de la tabla "barbero"
$query = "SELECT * FROM barbero";
$result = mysqli_query($conexion, $query);

// Obtener datos de la tabla "servicios"
$query2 = "SELECT * FROM servicios";
$result2 = mysqli_query($conexion, $query2);

// Recuperar valores de la sesión o establecer valores predeterminados
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$celular = isset($_SESSION['celular']) ? $_SESSION['celular'] : '';
$correo = isset($_SESSION['correo']) ? $_SESSION['correo'] : '';
$barbero = isset($_SESSION['barbero']) ? $_SESSION['barbero'] : '';
$servicio = isset($_SESSION['servicio']) ? $_SESSION['servicio'] : '';
$fecha = isset($_SESSION['fecha']) ? $_SESSION['fecha'] : date('Y-m-d');
$hora = isset($_SESSION['hora']) ? $_SESSION['hora'] : '9:00';

// Limpiar la sesión después de recuperar los valores
$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/agenda.css">
    <link rel="icon" href="../img/logo.png">
    <title>KALI4NIA</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Selecciona una fecha y hora</h1>
        <form id="agendaForm" action="agendar_2.php" method="post">
            <!-- Campo para tu nombre -->
            <label for="nombre">Tu nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

            <!-- Campo para número de celular -->
            <label for="celular">Número de celular:</label>
            <input type="text" id="celular" name="celular" value="<?php echo $celular; ?>" required>

            <!-- Campo para correo electrónico -->
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>

            <!-- Seleccionar barbero -->
            <label for="barbero">Barbero:</label>
            <select id="barbero" name="barbero" onchange="actualizarImagen()" required>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $selected = ($barbero == $row['nombre']) ? 'selected' : '';
                    echo '<option value="' . $row['nombre'] . '" ' . $selected . '>' . $row['nombre'] . '</option>';
                }
                ?>
            </select>

            <!-- Seleccionar servicio -->
            <label for="servicio">Servicio:</label>
            <select id="servicio" name="servicio" onchange="actualizarPrecio()" required>
                <?php
                while ($row2 = mysqli_fetch_assoc($result2)) {
                    $selected = ($servicio == $row2['nombre']) ? 'selected' : '';
                    echo '<option value="' . $row2['nombre'] . '" ' . $selected . '>' . $row2['nombre'] . '</option>';
                }
                ?>
            </select>

            <!-- Seleccionar fecha -->
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $fecha; ?>"
                required>

            <!-- Seleccionar hora -->
            <label for="hora">Hora:</label>
            <select id="hora" name="hora" required>
                <?php
                // Generar opciones para las horas de 9am a 9pm
                for ($hour = 9; $hour <= 21; $hour++) {
                    $selected = ($hora == "$hour:00") ? 'selected' : '';
                    echo "<option value=\"$hour:00\" $selected>$hour:00</option>";
                }
                ?>
            </select>

            <!-- Campo de precio no editable -->
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="" readonly>

            <!-- Botón de consulta -->
            <button type="submit">Continuar</button>
        </form>
    </div>

    <script>
        const fechaInput = document.getElementById('fecha');

        // Obtener la fecha actual en el formato 'YYYY-MM-DD'
        const today = new Date().toISOString().split('T')[0];

        // Establecer el valor mínimo del campo de fecha
        fechaInput.min = today;

        // Actualizar la fecha actual cada segundo
        setInterval(() => {
            const currentTime = new Date().toISOString().split('T')[0];
        }, 1000);
        // Función para actualizar el precio cuando cambia el servicio
        function actualizarPrecio() {
            var servicioSelect = document.getElementById('servicio');
            var precioInput = document.getElementById('precio');
            var selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
            var servicioNombre = selectedOption.value;

            // Realizar una solicitud AJAX para obtener el precio del servicio
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var precio = xhr.responseText;
                    precioInput.value = precio;
                }
            };

            xhr.open('GET', 'obtener_precio_servicio.php?servicio=' + servicioNombre, true);
            xhr.send();
        }
    </script>
</body>

</html>
