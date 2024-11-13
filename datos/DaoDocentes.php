<?php
// Importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/Docentes.php'; 

if (session_status() === PHP_SESSION_ACTIVE) {
    echo "La sesión está activa.";
} else {
    session_start();
}

class DaoDocentes
{
    private $ConL;

    // Conexión a la base de datos
    function conectar() {
        $Con = new Conexion();
        $this->ConL = $Con::obtenerConexion();
    }

    // Función para agregar un nuevo docente a la base de datos
    public function agregar(Docentes $obj) {
        try {
            // Consulta SQL para insertar en la tabla Usuarios
            $sql = "INSERT INTO Usuarios
                (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf, carrera, semestre)
                VALUES
                (:usuario, :nombre, sha2(:contrasenia,224), :veiculo, :discapacidad, 1, :carrera, :semestre);";
                
            $this->conectar();
            $stmt = $this->ConL->prepare($sql);
            
            $stmt->execute(array(
                ':usuario' => $obj->usuario,
                ':nombre' => $obj->nombre,
                ':contrasenia' => $obj->contrasenia,
                ':veiculo' => $obj->veiculo, // 0 para moto, 1 para carro
                ':discapacidad' => $obj->discapacidad,
                ':carrera' => $obj->carrera,
                ':semestre' => 1 // Valor fijo para cumplir con la estructura (no relevante para docentes)
            ));
            
            return true;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
?>
