<?php
//codigó para verificar que la persona si haya iniciado sesión

//iniciamos la sesión
session_start();
if (!isset($_SESSION['ingreso_admin'])) {
    //si la persona no ha iniciado sesión entonces lo redirigue al index
    header("location: ../../index.php");
    exit;
}
//fin de codigo
include_once('../../config/database.php');

$consulta_datos = "SELECT * FROM valores";
$resultado = mysqli_query($conexion, $consulta_datos);
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
    <link rel="stylesheet" href="assets/css/panel.css">
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

    <!-- panel de control (valores de ingres y demas cosas) -->

    <?php 
    //Valores que hay en la base de datos
    while ($row = mysqli_fetch_assoc($resultado)){
    ?>
    <div class="cifras">
        <div class="contenido-cifras">
            <div class="relleno-cifra">
                <h1>USUARIOS</h1>
                <h1><?php echo $row['barberos']; ?></h1>
            </div>
            <div class="relleno-cifra-1">
                <h1>CITAS</h1>
                <h1><?php echo $row['todas']; ?></h1>
            </div>
            <div class="relleno-cifra-1">
                <h1>SERVICIOS</h1>
                <h1><?php echo $row['servicios']; ?></h1>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- script -->

    <script>
        function toggleMenu() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('show-menu');
        }
    </script>
</body>

</html>