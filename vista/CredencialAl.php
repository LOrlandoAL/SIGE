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
            // Código PHP que genera el código QR
            require "../phpqrcode/qrlib.php";
            require "../datos/DaoCredencialAL.php";

            if (!isset($_SESSION)) {
                session_start();
            }

            if (isset($_SESSION["us"])) {
                $Datos = new DaoCredencialAL;
                $jsonData = $Datos->obtenerDatos($_SESSION["us"]);
                $dir = 'qr_codes/';
                $filename = $dir . 'codigo_qr.png';
                $tamaño = 10;
                $margen = 4;
                QRcode::png($jsonData, $filename, 'L', $tamaño, $margen);
                echo '<img src="' . $filename . '" alt="Código QR">';
            } else {
                echo "La sesión no está activa.";
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
