<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoMotos.php");
if (session_status() === PHP_SESSION_ACTIVE) {
   
} else {
    session_start();
    
}

// Revisar que lleguen los datos
 //isset($_POST["server"]) && isset($_POST["puerto"]) && 
if (isset($_POST["usuario"])) {
    // Revisar en BD que esten correctas
    $Hayconexion = new Conexion();
    $con= $Hayconexion::obtenerConexion();
    

    if ($con!=null) {
        $DaoMotos = new DAOMotos();
        
        if (session_status() === PHP_SESSION_ACTIVE) {
     
        }  else {
            
            session_start();

        }
        $Si=$DaoMotos->Existe($_POST["usuario"]);
        if($Si)
        {
            $es=$DaoMotos->ObtenerIdEs($_POST["usuario"]);
            $idEspacio = $es["idEspacio"];
            $DaoMotos->salida($_POST["usuario"], $idEspacio);
           header("Location: EntradaMotos.php");
            
            }
        else{
                    
            $DaoMotos->Entrada($_POST["usuario"]);
            $es=$DaoMotos->ObtenerIdEs($_POST["usuario"]); 
            $idEspacio = $es["idEspacio"];
            $mensaje = "te toco el lugar".$idEspacio;
            $mensaje_codificado = urlencode($mensaje);   
            header("Location: EntradaMotos.php?mensaje=$mensaje_codificado");
            exit();
        }
    }
    //header("Location: index.php");
}else{
    echo("NO HAY VALORES");
}

//header("Location: index.php");
?>