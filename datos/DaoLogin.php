<?php
//importa la clase conexi�n y el modelo para usarlos
require_once 'conexion.php'; 
class DAOLogin
{
    
	private $conexion; 
    
    /**
     * Permite obtener la conexi�n a la BD
     */
    private function conectar(){
        try{
			$Con = new Conexion();
            $this->conexion = $Con::obtenerConexion();
		}
		catch(Exception $e)
		{
			die($e->getMessage()); /*Si la conexion no se establece se cortara el flujo enviando un mensaje con el error*/
		}
    }
    
   
   
    public function login($id, $contrasenia)
    {
        try 
        {
            $sql = "SELECT id, usuario, contrasenia FROM Usuarios
                    WHERE usuario = :usuario AND contrasenia = SHA2(:contrasenia, 224);";
                    
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':usuario' => $id, ':contrasenia' => $contrasenia));
                       
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
                return true; // Si se encuentra un resultado, devuelve true
            } else {
                return false; // Si no se encuentra ningún resultado, devuelve false
            }
        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }

    public function esAdmin($usuario)
{
    try 
    {
        $sql = "SELECT Administrador FROM Usuarios
                WHERE usuario = :usuario;";
        
        $this->conectar();
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute(array(':usuario' => $usuario));
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado) {
            return (bool)$resultado['Administrador']; // Devuelve true si es administrador, false si no
        } else {
            return false; // Usuario no encontrado
        }
    } catch (Exception $e) {
        exit($e->getMessage());
    } finally {
        // Cerrar conexión o realizar otras tareas de limpieza si es necesario
    }
}

	
}