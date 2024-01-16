<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../imagenes/logo.png" />
    <title>KALI4NIA</title>
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
            color: white;
            backdrop-filter: blur(2px);
            overflow-y: scroll; /* Agregado para permitir desplazamiento vertical en dispositivos móviles */
        }

        form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        input[type="text"],
        input[type="file"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #333;
            color: white;
        }

        input[type="submit"] {
            margin: 10px;
            background-color: green;
            color: white;
            cursor: pointer;
            margin-bottom: 0;
        }

        input[type="submit"]:hover {
            color: black;
            background-color: yellow;
        }

        input[type="submit"]:nth-child(2) {
            background-color: red;
        }

        input[type="submit"]:nth-child(2):hover {
            background-color: yellow;
        }

        img {
            border-radius: 50%;
            width: 400px;
            height: 400px;
            margin-bottom: 15px;
            display: block;
        }
    </style>
</head>

<body>
    <?php
    session_start();

    if (!isset($_SESSION['ingreso_admin'])) {
        echo '
            <script>
                alert("Por favor debes iniciar sesión para acceder");
                window.location = "../../../../index.php";
            </script>
        ';
        session_destroy();
        die();
    }

    require '../../../../config/database.php';

    // Recuperar el correo del usuario a editar desde la URL
    $id = $_GET['id'];

    // Consulta para obtener los datos del usuario a editar
    $sqlUsuario = "SELECT id, imagen, nombre, descripcion, precio FROM servicios WHERE id = '$id'";
    $resultadoUsuario = $conexion->query($sqlUsuario);
    $usuario = $resultadoUsuario->fetch_assoc();
    ?>

    <!-- Formulario para editar los datos del usuario -->
    <form action="actualizar_servicio.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="correo" value="<?php echo $usuario['nombre']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>
        Descripcion: <input type="text" name="descripcion" value="<?php echo $usuario['descripcion']; ?>"><br>
        Precio: <input type="text" name="precio" value="<?php echo $usuario['precio']; ?>"><br>
        ID: <input type="text" name="id" value="<?php echo $usuario['id']; ?>" readonly><br>
        <?php
        // Mostrar la imagen actual si existe
        if (!empty($usuario['imagen'])) {
            echo '<img src="data:image/jpeg;base64,' . base64_encode($usuario['imagen']) . '" alt="Imagen actual">';
        }
        ?>
        Imagen: <input type="file" name="imagen"><br>
        <br>
        <!-- Agrega los campos restantes para editar -->
        <input type="submit" value="ACTUALIZAR">
        <input type="submit" value="CANCELAR" style="background-color: #d32f2f;" onclick="location.href='../../servicios.php'; return false;">
    </form>
</body>

</html>
