<?php
// Importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/Alumnos.php'; 

if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión está activa
} else {
    // La sesión no está activa
    session_start();
}

class DaoAlumnos
{
    private $ConL;
    
    function conectar()
    {
        $Con = new Conexion();
        $this->ConL = $Con::obtenerConexion();
    }

    public function agregar(Alumnos $obj)
    {
        try 
        {
            $sql = "INSERT INTO usuarios
                (usuario,
                nombre,
                carrera,
                discapacidad,
                veiculo,
                AluProf,
                semestre,
                contrasenia)
                VALUES
                (:usuario,
                :nombre,
                :carrera,
                :discapacidad,
                :veiculo,
                :AluProf,
                :semestre,
                sha2(:contrasenia,224));";
                
            $this->conectar();
            $stmt = $this->ConL->prepare($sql);
            $stmt->execute(array(
                ':usuario' => $obj->IdUsuarios,
                ':nombre' => $obj->nombre,
                ':carrera' => $obj->carrera,
                ':discapacidad' => $obj->discapacidad,
                ':veiculo' => $obj->veiculo,
                ':AluProf' => $obj->AluProf,
                ':semestre' => $obj->semestre,
                ':contrasenia' => $obj->contrasenia
            ));
            return true;
         
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }
}
?>
