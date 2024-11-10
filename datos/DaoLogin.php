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
            $sql = "SELECT IdUsuarios, contrasenia FROM Usuarios 
                    WHERE IdUsuarios = :id AND contrasenia = SHA2(:contra, 224);";
                    
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':id' => $id, ':contra' => $contrasenia));
                       
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($resultado) {
               
                return true; // Si se encuentra un resultado, devuelve true
            } else {
                //echo($resultado);
                return false; // Si no se encuentra ningún resultado, devuelve false
            }
        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }


	
}