<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_admin'])) {
    header("location: ../../index.php");
    exit;
}

// Incluir archivo de configuración de la base de datos
include_once('../../config/database.php');

// Obtener datos de la tabla "barbero"
$query = "SELECT * FROM barbero";
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
</head>

<body>
    <!-- header -->

    <div class="navbar">
        <div class="menu-icon" onclick="toggleMenu()">&#9776;</div>
        <a href="index.php">Panel</a>
        <a href="#servicios">Servicios</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="#agenda-completa">Agenda Completa</a>
        <a href="#mi-agenda">Mi Agenda</a>
        <a href="#caja">Caja</a>
        <a href="#configuracion">Configuración</a>
        <a href="../../php/cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>

    <!-- tabla de usuario -->

    <div class="tabla-usuarios">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Barbero</th>
                    <th>Administrador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar datos en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td data-label='Imagen'><img src='{$row['imagen']}' alt='Imagen de usuario' class='imagen-usuario'></td>";
                    echo "<td data-label='Nombre'>{$row['nombre']}</td>";
                    echo "<td data-label='Correo'>{$row['correo']}</td>";
                    echo "<td data-label='Barbero'>{$row['barbero']}</td>";
                    echo "<td data-label='Administrador'>{$row['administrador']}</td>";
                    echo "<td data-label='Acciones'>
                            <button class=\"btn-editar\" onclick=\"editarUsuario({$row['id']})\">Editar</button>
                            <button class=\"btn-eliminar\" onclick=\"eliminarUsuario({$row['id']})\">Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- boton para agregar los usuarios -->

    <div class="usuarios">
        <button onclick="agregarUsuario()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                <path
                    d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
            </svg> AGREGAR USUARIO</button>
    </div>

    <!-- script -->

    <script>
        function agregarUsuario() {
            window.location.href = 'assets/forms/usuarios.php';
        }
        function toggleMenu() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('show-menu');
        }
        function editarUsuario(id) {
            window.location.href = 'editar_usuario.php?id=' + id;
        }
        function eliminarUsuario(id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este usuario?");
            if (confirmacion) {
                window.location.href = 'eliminar_usuario.php?id=' + id;
            }
        }
    </script>
</body>

</html>