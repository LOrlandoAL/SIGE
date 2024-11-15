<?php
//importa la clase conexi�n y el modelo para usarlos
require_once 'conexion.php'; 
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión está activa
} else {
    // La sesión no está activa
    session_start();
}
class DaoUbicacion
{
    private $ConL;
    function conectar()
    {
        $Con = new Conexion();
        $this->ConL = $Con->obtenerConexion();
    }
    
    public function obtenerTipo($id){
    try 
    {
        $sql = "SELECT AluProf FROM Usuarios WHERE usuario = :id;";
                
        $this->conectar();
        $stmt = $this->ConL->prepare($sql);
        $stmt->execute(array(':id' => $id));
                   
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            return $resultado['AluProf']; // Devuelve el valor del campo 'tipo'
        } else {
            return false; // Si no se encuentra ningún resultado, devuelve false
        }
    } catch (Exception $e){
        exit($e->getMessage());
    } finally {
        // Cerrar conexión o realizar otras tareas de limpieza si es necesario
    }
}


}