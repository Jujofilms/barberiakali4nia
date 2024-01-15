<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" type="image/x-icon" href="../img/logo.png"/>
    <meta name="description" content="Inicar Sesión de administrador Barberia California">
    <title>Iniciar Sesión - KALI4NIA</title>
</head>
<body>
    <div class="container">
        <form action="login_be.php" method="post">
            <h1>Iniciar Sesión</h1>

            <label for="correo">Correo:</label>
            <input placeholder="Correo Electrónico" type="email" id="correo" name="correo" required>

            <label for="contrasena">Contraseña:</label>
            <div class="password-container">
                <input placeholder="Contraseña" type="password" id="contrasena" name="contrasena" required>
            </div>

            <a href="recovery.php" class="btn-forgot">¿Olvidaste tu contraseña?</a>

            <div class="button-container">
                <button type="submit">Iniciar Sesión</button>
                <a href="../index.php" class="btn-volver">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>
