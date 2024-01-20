<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../img/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('../img/fondo-2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden; /* Evitar el desplazamiento vertical del body */
        }

        .card {
            text-align: center;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            max-width: 400px;
            height: auto;
        }

        h1 {
            color: #007bff;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <title>KALI4NIA</title>
</head>

<body>
    <div class="card">
        <h1>Se ha agendado tu cita</h1>
        <button onclick="window.location.href='../index.php'">Continuar</button>
    </div>
</body>

</html>
