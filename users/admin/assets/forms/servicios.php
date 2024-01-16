<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Servicio - Barberia Kali4nia</title>
    <link rel="icon" href="../../../img/logo.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("../../../../img/fondo.jpg");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow-y: auto; /* Agregado para permitir scroll vertical */
        }

        .fomurlario_usuario {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .formulario {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin: 10px 0;
        }

        input {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .barbero-check {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .barbero-check label {
            margin: 10px 0;
        }

        .boton {
            padding: 10px;
            margin: 5px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .boton:hover {
            background-color: yellow;
            color: black;
        }

        .boton-cancelar {
            background-color: #d9534f;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .boton-cancelar:hover {
            background-color: yellow;
            color: white;
        }
    </style>
</head>

<body>
    <div class="fomurlario_usuario">
        <div class="formulario">
            <form action="servicios_be.php" method="post" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                <label for="descripcion">Descripcion:</label>
                <input type="text" placeholder="Descripcion" name="descripcion" id="descripcion" required>
                <label for="precio">Precio:</label>
                <input type="number" placeholder="Precio" name="precio" id="precio" required>
                <label for="imagen">Subir Imagen:</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">
                <button class="boton">AGREGAR</button>
            </form>
            <button class="boton boton-cancelar" onclick="cancelar()">CANCELAR</button>
        </div>
    </div>

    <script>
        function cancelar() {
            window.location.href = '../../servicios.php';
        }
    </script>
</body>

</html>
