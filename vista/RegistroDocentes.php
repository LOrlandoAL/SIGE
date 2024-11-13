<?php
require_once("../datos/conexion.php");
require_once("../datos/DaoDocentes.php");
require_once("../modelos/Docentes.php");

if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
    var_dump("SE CERRO LA SESIÓN");
} else {
    session_start();
}

$Hayconexion = new Conexion();
$con = $Hayconexion::obtenerConexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST); // Verifica el contenido de $_POST
}

if ($con != null) {
    if (session_status() === PHP_SESSION_ACTIVE) {
        $dao = new DaoDocentes();
    } else {
        session_start();
    }
    
    // Validar los campos esenciales
    if (isset($_POST["Nombre"]) && isset($_POST["Matricula"]) && isset($_POST["Carrera"]) && isset($_POST["discapacidad"]) && isset($_POST["contrasenia"]) && isset($_POST["veiculo"])) {
        
        // Crear una instancia de Docentes y asignar los valores recibidos
        $OBJDocente = new Docentes();
        $OBJDocente->usuario = $_POST['Matricula'];
        $OBJDocente->nombre = $_POST['Nombre'];
        $OBJDocente->carrera = $_POST['Carrera'];
        $OBJDocente->discapacidad = $_POST['discapacidad'];
        $OBJDocente->veiculo = $_POST['veiculo'];
        $OBJDocente->contrasenia = $_POST['contrasenia'];
        
        // Fijar valores predeterminados para semestre, ya que no se utiliza para docentes
        $OBJDocente->semestre = 1; // Valor fijo para cumplir con la estructura de la tabla

        if ($dao->agregar($OBJDocente)) {
            $_SESSION['mensaje'] = "<p style='color: green;'>Docente registrado correctamente.</p>";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['mensaje'] = "<p style='color: red;'>Error al registrar el docente.</p>";
            header("Location: RegistroDocentes.php");
            exit();
        }
    } else {
        echo "FALTAN DATOS";
    }
}
?>
