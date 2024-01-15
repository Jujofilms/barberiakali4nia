<?php
if ($_SERVER["REQUEST_METHOD"] != "GET" || !isset($_GET['token'])) {
    redireccionarALogin();
}

function redireccionarALogin() {
    header("location: login.php");
    exit;
}

$token = $_GET['token'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña - KALI4NIA</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/logo.png"/>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <div class="formulario-login">
            <div class="formulario">
                <h1>Cambiar Contraseña</h1>
                <form action="update_password_be.php?token=<?php echo $token; ?>" method="post">
                    <label for="password">Nueva Contraseña:</label>
                    <input type="password" id="password" placeholder="Nueva contraseña" name="password" required>
                    <Button>CAMBIAR CONTRASEÑA</Button>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>
</body>
</html>
