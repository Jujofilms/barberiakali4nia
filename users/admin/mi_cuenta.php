<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_admin'])) {
    header("location: ../../index.php");
    exit;
}

require '../../config/database.php';

// Consulta SQL para obtener la información de la tabla 'barbero'
$correo = $_SESSION['ingreso_correo'];
$sql = "SELECT id, nombre, correo, imagen, administrador, barbero FROM barbero WHERE correo = '$correo'";
$resultado = $conexion->query($sql);

// Comprobar si se encontraron registros
if ($resultado->num_rows > 0) {
    // Extraer datos de la fila
    $fila = $resultado->fetch_assoc();
    $id = $fila['id'];
    $nombre = $fila['nombre'];
    $correo = $fila['correo'];
    $imagenBase64 = base64_encode($fila['imagen']);
    $esAdministrador = ($fila['administrador'] == 1) ? "Administrador" : "";
    $esBarbero = ($fila['barbero'] == 1) ? "Barbero" : "";
} else {
    // No se encontraron registros
    echo "No se encontraron registros.";
    exit;
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Panel administrativo de la barberia KALI4NIA">
    <meta name="description" content="Solo puedes ingresar si ha iniciado sesión">
    <title>KALI4NIA</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="assets/css/mi_cuenta.css">
</head>

<body>
    <!-- header -->

    <div class="navbar">
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <a href="index.php">Panel</a>
        <a href="servicios.php">Servicios</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="agenda_completa.php">Agenda Completa</a>
        <a href="mi_agenda.php">Mi Agenda</a>
        <a href="mi_cuenta.php">Mi Cuenta</a>
        <a href="../../php/cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Información del usuario -->
        <div class="user-info">
            <img src="data:image/png;base64,<?php echo $imagenBase64; ?>" alt="Imagen de perfil">
            <h2>
                <?php echo $nombre; ?>
            </h2>
            <p>
                <?php echo $correo; ?>
            </p>
            <p class="user-role">
                <?php echo $esAdministrador . " " . $esBarbero; ?>
            </p>
            <!-- Botón de editar -->
            <a href="assets/forms/editar_cuenta.php?id=<?php echo $id; ?>" class="edit-button">EDITAR</a>
        </div>
    </div>

    <!-- script -->

    <script>
        function toggleMenu() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('show-menu');
        }
    </script>
</body>

</html>
