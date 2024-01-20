<?php
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    // Redirigir a la página de usuarios si la solicitud no es de tipo POST
    header("location: agendar.php");
    exit;
}
// Incluir archivo de configuración de la base de datos
include_once('../config/database.php');

// Variables de POST
$nombre = $_POST['nombre'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
$barbero = $_POST['barbero'];
$servicio = $_POST['servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$precio = $_POST['precio'];

// Iniciar o reanudar la sesión
session_start();

// Obtener datos de la tabla "barbero"
$query = "SELECT imagen FROM barbero WHERE nombre = '$barbero'";
$result = mysqli_query($conexion, $query);

// Verificar si se encuentra el barbero
if ($row = mysqli_fetch_assoc($result)) {
    $imagenBase64 = base64_encode($row['imagen']);
} else {
    // Si no se encuentra la información del barbero, establecer una imagen predeterminada
    $imagenBase64 = base64_encode(file_get_contents('../img/no-photo.jpg'));
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../img/fondo-2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
            /* Evitar el desplazamiento vertical del body */
        }

        .container {
            text-align: center;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-width: 100%;
            height: 80vh;
            /* Ajustar la altura máxima del contenedor */
        }

        .container img {
            width: 100px;
            height: 100px;
            border-radius: 20%;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 8px;
            text-align: left;
            width: 100%;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        input,
        select,
        button {
            margin-bottom: 16px;
            padding: 12px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .volver {
            background-color: #ccc;
            color: #000;
            margin-top: 20px;
            display: block;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
        }

        .volver:hover {
            background-color: #999;
        }
    </style>
    <title>KALI4NIA</title>
</head>

<body>
    <div class="container">
        <h1>CONFIRMA TUS DATOS</h1>
        <form id="agendaForm" action="agendar_be.php" method="post">
            <!-- Campos ocultos para enviar datos a la siguiente página -->
            <input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
            <input type="hidden" name="celular" value="<?php echo $celular; ?>">
            <input type="hidden" name="correo" value="<?php echo $correo; ?>">
            <input type="hidden" name="barbero" value="<?php echo $barbero; ?>">
            <input type="hidden" name="servicio" value="<?php echo $servicio; ?>">
            <input type="hidden" name="fecha" value="<?php echo $fecha; ?>">
            <input type="hidden" name="hora" value="<?php echo $hora; ?>">
            <input type="hidden" name="precio" value="<?php echo $precio; ?>">

            <!-- Campo para tu nombre -->
            <label for="nombre">Tu nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>

            <!-- Campo para número de celular -->
            <label for="celular">Número de celular:</label>
            <input type="text" id="celular" name="celular" value="<?php echo $celular; ?>" required>

            <!-- Campo para correo electrónico -->
            <label for="correo">Correo electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $correo; ?>" required>

            <!-- Campo para el barbero -->
            <label for="barbero">Barbero:</label>
            <input type="text" id="barbero" name="barbero" value="<?php echo $barbero; ?>" readonly>

            <!-- Imagen del barbero -->
            <img src="data:image/jpeg;base64, <?php echo $imagenBase64; ?>" alt="Imagen del barbero">

            <!-- Campo para el servicio -->
            <label for="servicio">Servicio:</label>
            <input type="text" id="servicio" name="servicio" value="<?php echo $servicio; ?>" readonly>

            <!-- Campo para la fecha -->
            <label for="fecha">Fecha de la cita:</label>
            <input type="text" id="fecha" name="fecha" value="<?php echo $fecha; ?>" readonly>

            <!-- Campo para la hora -->
            <label for="hora">Hora de la cita:</label>
            <input type="text" id="hora" name="hora" value="<?php echo $hora; ?>" readonly>

            <label for="precio">Precio del servicio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo $precio; ?>" readonly>
            <!-- Botón de consulta -->
            <button type="submit">AGENDAR</button>

            <!-- Botón de volver -->
            <a class="volver" href="agendar.php">Volver</a>
        </form>
    </div>
</body>

</html>