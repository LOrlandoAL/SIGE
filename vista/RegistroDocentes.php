<?php
require_once("..\datos\conexion.php");
require_once("..\datos\DaoDocentes.php");
require_once("..\modelos\Docentes.php");
if (session_status() === PHP_SESSION_ACTIVE) {
   session_destroy();
   var_dump("SE CERRO LA SESSION");
} else {
    session_start();
   // echo "La sesión no está activa.";
}

    $Hayconexion = new Conexion();
    $con= $Hayconexion::obtenerConexion();
    //var_dump($con);

    
        if ($con!=null) {
            if (session_status() === PHP_SESSION_ACTIVE) {
                $dao = new DaoDocentes();

            }  else {
                // La sesión no está activa
                session_start();
            }
            
            if(isset($_POST["Nombre"])&&isset($_POST["Matricula"])&&isset($_POST["Area"])&&isset($_POST["Puesto"])&&isset($_POST["discapacidad"])&&isset($_POST["contrasenia"]))
            {
                $OBJAlumno = new Docentes();
                $OBJAlumno->IdUsuarios = $NoCrontol = $_POST['Matricula'];
                $OBJAlumno->nombre = $nombre = $_POST['Nombre'];
                $OBJAlumno->carrrera_area = $carrrera_area = $_POST['Area'];
                $OBJAlumno->discapacidad = $discapacidad  = $_POST['discapacidad'];
                $OBJAlumno->tipo = $tipo  = $_POST['Tipo'];
                $OBJAlumno->puesto = $puesto = $_POST['Puesto'];
                $OBJAlumno->semestre = $semestre = $_POST['Semestre'];
                $OBJAlumno->contrasenia = $contrasenia = $_POST['contrasenia'];
                
                if ($dao->agregar($OBJAlumno)) {
                    $_SESSION['mensaje'] = "<p style='color: green;'>Prestamo insertado correctamente.</p>";
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION['mensaje'] = "<p style='color: red;'>Error al registrar el prestamo.</p>";
                    header("Location: Alumno.php");
                    exit();
                }
            }
            else{
                var_dump(($_POST["Puesto"]));
                echo"FALTAN DATOS";
            }
        }
        
    
//header("Location: index.php");

?>