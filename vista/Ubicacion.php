<?php
//importa la clase conexión y el modelo para usarlos
require_once '../datos/conexion.php'; 
require_once("../datos/DaoUbicacion.php");

// Iniciar sesión al principio del script
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión está activa
    echo "La sesión está activa.";
} else {
    // La sesión no está activa
    session_start();
}
if (isset($_SESSION["us"])) {
    $usuario = $_SESSION["us"];
    // Aquí puedes utilizar el valor de $usuario como lo necesites
    //echo "Bienvenido, $usuario";

    $Hayconexion = new Conexion();
    $con = $Hayconexion::obtenerConexion();
    
    if ($con != null) {
        $DaoUbicacion = new DaoUbicacion();

        // Obtener el tipo de usuario
        $tipoUsuario = $DaoUbicacion->obtenerTipo($usuario);

        if ($tipoUsuario != "0") { // 0 iIndica que somos un alumno siguiedo el modelo de ALUMNOPROFESOR respectivamente 01
            header("Location: CredencialDos.php");
            exit; // Detener la ejecución del script después de redirigir
        } else {
            
            header("Location: CredencialAl.php");
            exit; // Detener la ejecución del script después de redirigir
        }
    }
} else {
    echo "No se ha proporcionado el usuario";
}
?>
