<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #e9f7ef; /* Fondo verde claro */
        }

        .container {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 128, 0, 0.1);
            text-align: center;
        }

        h2 {
            color:black ; /* Verde oscuro para el título */
            margin-bottom: 15px;
            font-size: 24px;
        }

        p {
            color: black; /* Verde medio para el texto de descripción */
            font-size: 14px;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #c8e6c9; /* Borde verde claro */
            border-radius: 5px;
            font-size: 16px;
            color: #2e7d32;
            background-color: #f1f8e9; /* Fondo verde muy claro */
        }

        .btn {
            width: 100%;
            padding: 10px;
            background-color: #66bb6a; /* Verde para el botón */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #43a047; /* Verde más oscuro al pasar el ratón */
        }

        .back-link {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            color: #388e3c; /* Verde para el enlace de volver */
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Recuperación de Contraseña</h2>
        <p>Manda un correo ala siguiente direccion para recuperar tu contraseña, indicando tu usuario, nos contactaremos contigo pronto.</p>
        <form method="post">
            <button type="button" class="btn">LockPicking@SIGE.support.co</button>
        </form>
        <a href="index.php" class="back-link">Volver al inicio de sesión</a>
    </div>
</body>
</html>

