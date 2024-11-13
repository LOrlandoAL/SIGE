<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoAlumnos.php");
require_once("../modelos/Alumnos.php");

session_start();

$conexion = new Conexion();
$con = $conexion::obtenerConexion();

if ($con != null) {
    $dao = new DaoAlumnos();

    if (isset($_POST["nombre"]) && isset($_POST["NoControl"]) && isset($_POST["carrera"]) && isset($_POST["semestre"]) && isset($_POST["discapacidad"]) && isset($_POST["contrasenia"])) {
        $OBJAlumno = new Alumnos();
        $OBJAlumno->IdUsuarios = $_POST['NoControl'];
        $OBJAlumno->nombre = $_POST['nombre'];
        $OBJAlumno->carrera = $_POST['carrera'];
        $OBJAlumno->discapacidad = $_POST['discapacidad'];
        $OBJAlumno->veiculo = isset($_POST['veiculo']) ? $_POST['veiculo'] : true; // Default true para Carro
        $OBJAlumno->AluProf = 0; // Bloqueado para alumnos
        $OBJAlumno->semestre = $_POST['semestre'];
        $OBJAlumno->contrasenia = $_POST['contrasenia'];
        
        if ($dao->agregar($OBJAlumno)) {
            $_SESSION['mensaje'] = "<p style='color: green;'>Alumno registrado correctamente.</p>";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['mensaje'] = "<p style='color: red;'>Error al registrar el alumno.</p>";
            header("Location: Alumno.php");
            exit();
        }
    } else {
        echo "FALTAN DATOS";
    }
}
?>
