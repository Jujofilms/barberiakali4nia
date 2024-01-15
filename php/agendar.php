<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/agendar.css">
    <title>KALI4NIA</title>
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Selecciona una fecha</h1>
        <form action="agenda.php" method="post">
            <label for="fecha">Fecha:</label>
            <!-- Establecer el atributo "min" con la fecha actual -->
            <input type="date" id="fecha" name="fecha" min="" required>
            <button type="submit">Consultar Disponibilidad</button>
        </form>
    </div>

    <script>
        // Obtener el elemento de fecha
        const fechaInput = document.getElementById('fecha');

        // Obtener la fecha actual en el formato 'YYYY-MM-DD'
        const today = new Date().toISOString().split('T')[0];

        // Establecer el valor mínimo del campo de fecha
        fechaInput.min = today;

        // Actualizar la fecha actual cada segundo
        setInterval(() => {
            const currentTime = new Date().toISOString().split('T')[0];
            fechaInput.value = currentTime;
        }, 1000);
    </script>
</body>

</html>
