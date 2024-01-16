<?php
session_start();

// Verificar la sesión
if (!isset($_SESSION['ingreso_admin'])) {
    header("location: ../../index.php");
    exit;
}

require '../../../../config/database.php';

// Recuperar el ID del usuario a editar desde la URL
$id = $_GET['id'];

// Consulta SQL para obtener los datos del usuario a editar
$sqlUsuario = "SELECT id, nombre, correo, imagen FROM barbero WHERE id = '$id'";
$resultadoUsuario = $conexion->query($sqlUsuario);

// Comprobar si se encontraron registros
if ($resultadoUsuario->num_rows > 0) {
    // Extraer datos de la fila
    $usuario = $resultadoUsuario->fetch_assoc();
    $nombreEditar = $usuario['nombre'];
    $correoEditar = $usuario['correo'];
    $imagenBase64Editar = base64_encode($usuario['imagen']);
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
    <title>KALI4NIA - Editar Cuenta</title>
    <link rel="icon" href="../../img/logo.png">
    <link rel="stylesheet" href="assets/css/editar_cuenta.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../../../../img/fondo-2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            /* Esto asegura que la imagen de fondo permanezca fija al hacer scroll */
            backdrop-filter: blur(10px);
            overflow-y: scroll;
            /* Agregado para permitir desplazamiento vertical en dispositivos móviles */
        }

        .container {
            margin-top: 5%;
            text-align: center;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        form img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            display: block;
            margin: 0 auto 15px;
        }

        form input[type="text"],
        form input[type="file"],
        form input[type="submit"],
        form a.cancel-button {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #333;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            font-size: 15px;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        form input[type="submit"]:hover {
            background-color: yellow;
            color: black;
        }

        form a.cancel-button {
            background-color: #d32f2f;
            color: white;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            padding: 10px;
        }

        form a.cancel-button:hover {
            background-color: yellow;
            color: black;
        }
    </style>
</head>

<body>

    <!-- Contenedor principal -->
    <div class="container">
        <!-- Formulario para editar los datos del usuario -->
        <form action="actualizar_cuenta.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            Nombre: <input type="text" name="nombre" value="<?php echo $nombreEditar; ?>"><br>
            Correo: <input type="text" name="correo" value="<?php echo $correoEditar; ?>"><br>
            <!-- Mostrar la imagen actual si existe -->
            <?php
            if (!empty($imagenBase64Editar)) {
                echo '<img src="data:image/jpeg;base64,' . $imagenBase64Editar . '" alt="Imagen actual">';
            }
            ?>
            Imagen: <input type="file" name="imagen"><br>
            <br>
            <input type="submit" value="ACTUALIZAR">
            <a href="mi_cuenta.php" class="cancel-button">CANCELAR</a>
        </form>
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