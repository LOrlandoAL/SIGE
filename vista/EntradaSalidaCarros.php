<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoCarros.php");

if (session_status() === PHP_SESSION_ACTIVE) {
   session_destroy();
} else {
    session_start();
}

if (isset($_POST["usuario"])) {
    // Revisar en BD que estén correctos
    $Hayconexion = new Conexion();
    $con= $Hayconexion::obtenerConexion();

    if ($con != null) {
        $DaoCarros = new DAOCarros();
        
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $Si = $DaoCarros->Existe($_POST["usuario"]);
        
        if ($Si) {
            $es = $DaoCarros->ObtenerIdEs($_POST["usuario"]);
            
            if ($es !== null && isset($es["id_Espacio"])) {
                $idEspacio = $es["id_Espacio"];
                $DaoCarros->Salida($_POST["usuario"]);
                header("Location: EntradaCarros.php");
            } else {
                echo "No se encontró un espacio asignado para el usuario.";
            }
        } else {
            $DaoCarros->Entrada($_POST["usuario"]);
            $es = $DaoCarros->ObtenerIdEs($_POST["usuario"]);
            
            if ($es !== null && isset($es["id_Espacio"])) {
                $idEspacio = $es["id_Espacio"];
                $mensaje = "Te tocó el lugar " . $idEspacio;
                $mensaje_codificado = urlencode($mensaje);   
                header("Location: EntradaCarros.php?mensaje=$mensaje_codificado");
                exit();
            } else {
                echo "No se encontró un espacio asignado para el usuario después de la entrada.";
            }
        }
    }
} else {
    echo("NO HAY VALORES");
}
