<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperacion de contraseña - KALI4NIA</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/logo.png"/>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="formulario-login">
            <div class="formulario">
                <h1>Recuperar Contraseña</h1>
                <form action="recovery_be.php" method="post">
                    <label for="correo">Correo Electrónico:</label>
                    <input type="email" id="correo" placeholder="Correo Electrónico" name="correo" required>
                    <Button>RECUPERAR</Button>
                </form>
                <br><a href="login.php">VOLVER</a><br><br>
            </div>
        </div>
    </div>
    
</body>
</html>