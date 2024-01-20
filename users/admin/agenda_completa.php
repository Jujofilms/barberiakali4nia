<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_admin'])) {
    header("location: ../../index.php");
    exit;
}
$nombre = $_SESSION['ingreso_admin'];
// Incluir archivo de configuración de la base de datos
include_once('../../config/database.php');

// Obtener datos de la tabla "barbero"
$query = "SELECT * FROM agenda";
$result = mysqli_query($conexion, $query);
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
    <link rel="stylesheet" href="assets/css/usuarios.css">
    <style>
        .imagen-usuario {
            width: 100px;
            /* Ajusta el tamaño máximo de la imagen */
            height: 100px;
            /* Ajusta el tamaño máximo de la imagen */
            cursor: pointer;
            /* Cambia el cursor al hacer clic en la imagen */
            border-radius: 50%;
        }

        /* Estilo para la ventana modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        /* Estilo para el contenido de la ventana modal */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Estilo para cerrar la ventana modal */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* Estilo para la imagen en la ventana modal */
        .modal-img {
            width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <!-- header -->

    <div class="navbar">
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <a href="index.php">Panel</a>
        <a href="servicios.php">Servicios</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="agenda_completa">Agenda Completa</a>
        <a href="mi_agenda">Mi Agenda</a>
        <a href="mi_cuenta.php">Mi Cuenta</a>
        <a href="../../php/cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>

    <!-- tabla de usuario -->

    <div class="tabla-usuarios">
        <table>
            <thead>
                <tr>
                    <th>Barbero</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>correo</th>
                    <th>Fecha Cita</th>
                    <th>Hora Cita</th>
                    <th>Servicio</th>
                    <th>Valor servicio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar datos en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td data-label='Barbero'>{$row['barbero']}</td>";
                    echo "<td data-label='Cliente'>{$row['cliente']}</td>";
                    echo "<td data-label='Contacto'>{$row['contacto']}</td>";
                    echo "<td data-label='Correo'>{$row['correo']}</td>";
                    echo "<td data-label='Fecha'>{$row['fecha_cita']}</td>";
                    echo "<td data-label='Hora'>{$row['hora_cita']}</td>";
                    echo "<td data-label='Servicio'>{$row['servicio']}</td>";
                    echo "<td data-label='Valor'>{$row['valor_servicio']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>