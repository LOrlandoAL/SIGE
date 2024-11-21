<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoLogin.php");
if (session_status() === PHP_SESSION_ACTIVE) {
   session_destroy();
   //var_dump("SE CERRO LA SESSION");
} else {
    session_start();
    
   // echo "La sesión no está activa.";
}

// Revisar que lleguen los datos
 //isset($_POST["server"]) && isset($_POST["puerto"]) && 
if (isset($_POST["usuario"]) && isset($_POST["contrasenia"])) {
    // Revisar en BD que esten correctas
  
    $Hayconexion = new Conexion();
    $con= $Hayconexion::obtenerConexion();
    

    if ($con!=null) {
        $DaoLogin = new DAOLogin();
        
        if (session_status() === PHP_SESSION_ACTIVE) {
     
        }  else {
            // La sesión no está activa
            session_start();

        }
        $_SESSION['us'] = $_POST["usuario"];
            
        $Si=$DaoLogin->Login($_POST["usuario"],$_POST["contrasenia"]);

        if($Si)
        {

            if($DaoLogin->esAdmin($_POST["usuario"])){
                header("Location: Queja.php");
            }else{
                header("Location: Ubicacion.php");
            }
            
        }
        else{
            var_dump($_POST["usuario"]);
           header("Location: index.php");
        }
    }
    //header("Location: index.php");
}else{
    echo("NO HAY VALORES");
}

//header("Location: index.php");
?>