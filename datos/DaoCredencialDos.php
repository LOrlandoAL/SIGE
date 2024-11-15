<?php
// Importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 

session_start(); // Debes iniciar la sesión al principio del archivo si vas a verificar su estado

if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión está activa
    echo "La sesión está activa.";
} else {
    // La sesión no está activa
    echo "La sesión no está activa.";
}

class DaoCredencialAl
{
    private $ConL;
    
    function conectar()
    {
        $Con = new Conexion();
        $this->ConL = $Con->obtenerConexion();
    }

    public function obtenerDatos($id)
    {
        try 
        {
            $sql = "SELECT usuario, nombre, carrera, AluProf FROM Usuario WHERE usuarios = :id;";
                    
            $this->conectar();
            $stmt = $this->ConL->prepare($sql);
            $stmt->execute(array(':id' => $id));
                       
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {
                // Obtener los datos del usuario como un array asociativo
                $usuario = $resultado;
            
                // Convertir los datos del usuario a JSON
                $json_usuario = json_encode($usuario);
                return $json_usuario;
                // Imprimir el JSON
                //echo $json_usuario;
            } else {
                //echo "No se encontraron resultados para el usuario con ID $id";
            }
        } catch (PDOException $e){
            // Manejo de excepciones
            exit("Error al ejecutar la consulta: " . $e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }
}
?>
