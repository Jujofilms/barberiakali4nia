<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario - Barberia Kali4nia</title>
    <link rel="icon" href="../../../img/logo.png">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url("../../../../img/fondo.jpg");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
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
            font
        }

        .boton-cacelar:hover {
            background-color: yellow;
            color: white;
        }
    </style>
</head>

<body>
    <div class="fomurlario_usuario">
        <div class="formulario">
            <form action="usuarios_be.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" placeholder="Nombre" name="nombre" id="nombre" required>
                <label for="correo">Correo Electrónico:</label>
                <input type="email" placeholder="Correo Electrónico" name="correo" id="correo" required>
                <label for="contrasena">Contraseña</label>
                <input type="password" placeholder="Contraseña" name="contrasena" id="contrasena" required>
                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" id="imagen" required>
                <div class="barbero-check">
                    <label>CARGO:</label>
                    <label for="barbero">BARBERO</label>
                    <input type="checkbox" name="barber" id="barbero" onclick="toggleCheckbox('barbero')">
                    <label for="administrador">ADMINISTRADOR</label>
                    <input type="checkbox" name="administrador" id="administrador"
                        onclick="toggleCheckbox('administrador')">
                </div>
                <button class="boton">AGREGAR</button>
            </form>
            <button class="boton boton-cancelar" onclick="cancelar()">CANCELAR</button>
        </div>
    </div>

    <script>
        function toggleCheckbox(checkboxId) {
            const barberoCheckbox = document.getElementById("barbero");
            const adminCheckbox = document.getElementById("administrador");

            if (checkboxId === "barbero" && barberoCheckbox.checked) {
                adminCheckbox.checked = false;
            } else if (checkboxId === "administrador" && adminCheckbox.checked) {
                barberoCheckbox.checked = false;
            }
        }

        function cancelar() {
            window.location.href = '../../usuarios.php';
        }
    </script>
</body>

</html>