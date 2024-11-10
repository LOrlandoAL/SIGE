<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoCarros.php");
if (session_status() === PHP_SESSION_ACTIVE) {
   session_destroy();
   //var_dump("SE CERRO LA SESSION");
} else {
    session_start();
    
   // echo "La sesión no está activa.";
}

// Revisar que lleguen los datos
 //isset($_POST["server"]) && isset($_POST["puerto"]) && 
if (isset($_POST["usuario"])) {
    // Revisar en BD que esten correctas
  
    $Hayconexion = new Conexion();
    $con= $Hayconexion::obtenerConexion();
    

    if ($con!=null) {
        $DaoCarros = new DAOCarros();
        
        if (session_status() === PHP_SESSION_ACTIVE) {
     
        }  else {
            // La sesión no está activa
            session_start();

        }
        $Si=$DaoCarros->Existe($_POST["usuario"]);
        if($Si)
        {
            $es=$DaoCarros->ObtenerIdEs($_POST["usuario"]);
            $idEspacio = $es["idEspacio"];
            $DaoCarros->salida($_POST["usuario"], $idEspacio);
            header("Location: EntradaCarros.php");
        }
        else{
            $DaoCarros->Entrada($_POST["usuario"]);
            $es=$DaoCarros->ObtenerIdEs($_POST["usuario"]); 
            $idEspacio = $es["idEspacio"];
            $mensaje = "te toco el lugar".$idEspacio;
            $mensaje_codificado = urlencode($mensaje);   
            header("Location: EntradaCarros.php?mensaje=$mensaje_codificado");
            exit();
        }
    }
    //header("Location: index.php");
}else{
    echo("NO HAY VALORES");
}

//header("Location: index.php");
?>