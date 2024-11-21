<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página con Código QR</title>
    <link rel="stylesheet" href="css/qr.css">
    <link rel="stylesheet" href="css/Estilos.css">
</head>
<body>

    <!-- Encabezado con estilo verde similar al de la imagen -->
    <header>
        <div class="logo">
            <img src="imgs/SIGE.JPG" alt="Logo SIGE">
        </div>
    </header>
    
    <!-- Contenedor principal para centrar el contenido -->
    <div class="qr">
        <!-- Contenedor del código QR -->
        <div class="contenedor_QR">
            <?php
            // Incluir la librería QR Code y el DAO
            require "../phpqrcode/qrlib.php";
            require "../datos/DaoCredencialDos.php";

            // Iniciar sesión si no está activa
            if (!isset($_SESSION)) {
                session_start();
            }

            if (isset($_SESSION["us"])) {
                // La sesión está activa
                $Datos = new DaoCredencialAL;

                // Obtener los datos del usuario
                $jsonData = $Datos->obtenerDatos($_SESSION["us"]);

                // Directorio donde se almacenará el código QR generado
                $dir = 'qr_codes/';
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true); // Crear el directorio si no existe
                }

                // Nombre del archivo QR
                $filename = $dir . 'codigo_qr.png';

                // Tamaño y margen del código QR
                $tamaño = 10; // Ajustado para un tamaño visual adecuado
                $margen = 4;

                // Generar el código QR
                QRcode::png($jsonData, $filename, 'L', $tamaño, $margen);

                // Mostrar la imagen del código QR en el diseño
                echo '<img src="' . $filename . '" alt="Código QR" class="qr-image">';
            } else {
                echo '<p class="text-danger">La sesión no está activa.</p>';
            }
            ?>
        </div>

        <!-- Contenedor del mensaje de quejas -->
        <div class="contenedor_Mensaje">
            <p>¿Tienes quejas? <a href="queja.php">Haznos saber</a></p>
        </div>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>

</body>
</html>
