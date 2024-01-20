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
$query = "SELECT * FROM servicios";
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
    <link rel="stylesheet" href="assets/css/servicios.css">
    <style>
        .imagen-usuario {
            width: 100px;
            /* Ajusta el tamaño máximo de la imagen */
            height: 100px;
            /* Ajusta el tamaño máximo de la imagen */
            cursor: pointer;
            /* Cambia el cursor al hacer clic en la imagen */
            border-radius: 15px;
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
        <a href="agenda_completa.php">Agenda Completa</a>
        <a href="mi_agenda.php">Mi Agenda</a>
        <a href="mi_cuenta.php">Mi Cuenta</a>
        <a href="../../php/cerrar_sesion.php" class="logout-button">Cerrar Sesión</a>
    </div>

    <!-- tabla de usuario -->

    <div class="tabla-usuarios">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar datos en la tabla
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    $imagenBase64 = base64_encode($row['imagen']);
                    echo "<td data-label='Imagen'><img src='data:image/jpeg;base64,{$imagenBase64}' alt='Imagen de usuario' class='imagen-usuario' onclick='mostrarImagen(\"{$imagenBase64}\")'></td>";
                    echo "<td data-label='Nombre'>{$row['nombre']}</td>";
                    echo "<td data-label='Descripcion'>{$row['descripcion']}</td>";
                    echo "<td data-label='Precio'>$ " . number_format($row['precio'], 0, '.', ',') . "</td>";
                    echo "<td data-label='Acciones'>
                            <button class=\"btn-editar\" onclick=\"editarServicio({$row['id']})\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-pencil-square\" viewBox=\"0 0 16 16\">
                                <path d=\"M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z\"/>
                                <path fill-rule=\"evenodd\" d=\"M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z\"/>
                            </svg>
                            </button>
                            <button class=\"btn-eliminar\" onclick=\"eliminarServicio({$row['id']})\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-trash-fill\" viewBox=\"0 0 16 16\">
                                <path d=\"M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0\"/>
                            </svg>
                            </button>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- boton para agregar los usuarios -->

    <div class="usuarios">
        <button onclick="agregarServicio()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-box" viewBox="0 0 16 16">
                <path
                    d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
            </svg> AGREGAR SERVICIO</button>
    </div>

    <!-- Ventana modal para previsualizar la imagen -->
    <div id="imagenModal" class="modal">
        <span class="close" onclick="cerrarModal()">&times;</span>
        <img class="modal-content" id="imagenPrevia">
    </div>

    <!-- script -->

    <script>
        function agregarServicio() {
            window.location.href = 'assets/forms/servicios.php';
        }
        function toggleMenu() {
            var navbar = document.querySelector('.navbar');
            navbar.classList.toggle('show-menu');
        }
        function editarServicio(id) {
            window.location.href = 'assets/forms/editar_servicio.php?id=' + id;
        }
        function eliminarServicio(id) {
            var confirmacion = confirm("¿Estás seguro de que deseas eliminar este servicio?");
            if (confirmacion) {
                window.location.href = 'eliminar_servicio.php?id=' + id;
            }
        }
        function mostrarImagen(imagenBase64) {
            var modal = document.getElementById('imagenModal');
            var imagenPrevia = document.getElementById('imagenPrevia');

            // Mostrar la ventana modal y la imagen
            modal.style.display = 'block';
            imagenPrevia.src = 'data:image/jpeg;base64,' + imagenBase64;
        }

        function cerrarModal() {
            // Cerrar la ventana modal
            document.getElementById('imagenModal').style.display = 'none';
        }
    </script>
</body>

</html>