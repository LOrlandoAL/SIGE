<?php
//importa la clase conexi�n y el modelo para usarlos
require_once 'conexion.php'; 
require_once '../modelos/Alumnos.php'; 
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión está activa
    echo "La sesión está activa.";
} else {
    // La sesión no está activa
    session_start();
}
class DaoDocentes
{
    

    private $ConL;
    
    function conectar()
    {
        $Con = new Conexion();
        $this->ConL = $Con::obtenerConexion();
    }
    public function agregar(Docentes $obj)

	{
       
		try 
		{
            $sql = "INSERT INTO Usuarios
                (IdUsuarios,
                nombre,
                carrrera_area,
                discapacidad,
                tipo,
                puesto,
                semestre,
                contrasenia)
                VALUES
                (:IdUsuarios,
                :nombre,
                :carrera_area,
                :discapacidad,
                :tipo,
                :puesto,
                :semestre,
                sha2(:contrasenia,224));";
                
            $this->conectar();
            $this->ConL->prepare($sql)
                 ->execute(array(
                    ':IdUsuarios'=>$obj->IdUsuarios,
                    ':nombre'=>$obj->nombre,
                    ':carrera_area'=>$obj->carrrera_area,
                    ':discapacidad'=>$obj->discapacidad,
                    ':tipo'=>$obj->tipo,
                    ':puesto'=>$obj->puesto,
                    ':semestre'=>$obj->semestre,
                    ':contrasenia'=>$obj->contrasenia));
                    return true;
                 
         
		} catch (Exception $e){
			exit($e->getMessage());
		}finally{
            
            /*En caso de que se necesite manejar transacciones, 
			no deber� desconectarse mientras la transacci�n deba 
			persistir*/
            
            //$this->ConL->desconectar();
        }
	}

}