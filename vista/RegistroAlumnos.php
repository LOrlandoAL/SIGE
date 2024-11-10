<?php
require_once("..\datos\conexion.php");
require_once("..\datos\DaoAlumnos.php");
require_once("..\modelos\Alumnos.php");
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
                $dao = new DaoAlumnos();

            }  else {
                // La sesión no está activa
                session_start();
            }
            
            if(isset($_POST["Nombre"])&&isset($_POST["NoControl"])&&isset($_POST["Carrera"])&&isset($_POST["Semestre"])&&isset($_POST["discapacidad"])
              &&isset($_POST["contrasenia"]))
            {
                $OBJAlumno = new Alumnos();
                $OBJAlumno->IdUsuarios = $NoCrontol = $_POST['NoControl'];
                $OBJAlumno->nombre = $nombre = $_POST['Nombre'];
                $OBJAlumno->carrrera_area = $carrrera_area = $_POST['Carrera'];
                $OBJAlumno->discapacidad = $discapacidad  = $_POST['discapacidad'];
                $OBJAlumno->tipo = $tipo  = $_POST['Tipo'];
                $OBJAlumno->puesto = $puesto = $_POST['puesto'];
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
                echo"FALTAN DATOS";
            }
        }
        
    
//header("Location: index.php");

?>