<?php
// Incluye la librería QR Code
require "../phpqrcode/qrlib.php";
require "../datos/DaoCredencialDos.php";

// Iniciar sesión si no está activa
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION["us"])) {
    // La sesión está activa
    echo "La sesión está activa.";

    // Crea una instancia del objeto DaoCredencialAL
    $Datos = new DaoCredencialAL;

    // Obtiene los datos del usuario
    $jsonData = $Datos->obtenerDatos($_SESSION["us"]);

    // Directorio donde se almacenará el código QR generado (asegúrate de que tenga permisos de escritura)
    $dir = 'qr_codes/';

    // Nombre del archivo QR
    $filename = $dir . 'codigo_qr.png';

    // Tamaño y margen del código QR
    $tamaño = 100;
    $margen = 40;

    // Genera el código QR
    QRcode::png($jsonData, $filename, 'L', $tamaño, $margen);

    // Muestra la imagen del código QR en tu página HTML
    echo '<img src="' . $filename . '" alt="Código QR">';
} else {
    // La sesión no está activa
    echo "La sesión no está activa.";
}
?>
