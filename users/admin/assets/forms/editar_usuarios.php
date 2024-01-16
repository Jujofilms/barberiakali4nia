<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../imagenes/logo.png"/>
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
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            color: white;
            backdrop-filter: blur(2px);
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
        input[type="submit"] {
            width: calc(100% - 22px); /* Ajuste para que los inputs tengan el mismo ancho que los botones */
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
            margin-bottom: 0; /* Ajuste para eliminar el espacio entre los botones */
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
    $sqlUsuario = "SELECT id, nombre, correo, contrasena, barbero, administrador, bloqueo FROM barbero WHERE id = '$id'";
    $resultadoUsuario = $conexion->query($sqlUsuario);
    $usuario = $resultadoUsuario->fetch_assoc();
    ?>

    <!-- Formulario para editar los datos del usuario -->
    <form action="actualizar_usuario.php" method="POST">
        <input type="hidden" name="correo" value="<?php echo $usuario['correo']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>"><br>
        Correo: <input type="text" name="correo" value="<?php echo $usuario['correo']; ?>"><br>
        Barbero: <input type="text" name="barbero" value="<?php echo $usuario['barbero']; ?>"><br>
        Administrador: <input type="text" name="administrador" value="<?php echo $usuario['administrador']; ?>"><br>
        Bloqueo: <input type="text" name="bloqueo" value="<?php echo $usuario['bloqueo']; ?>"><br>
        ID: <input type="text" name="id" value="<?php echo $usuario['id']; ?>" readonly><br>
        <br>
        <!-- Agrega los campos restantes para editar -->
        <input type="submit" value="ACTUALIZAR">
        <input type="submit" value="CANCELAR" style="background-color: #d32f2f;" onclick="location.href='../../usuarios.php'; return false;">
    </form>
</body>
</html>
