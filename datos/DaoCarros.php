<?php
//importa la clase conexi�n y el modelo para usarlos
require_once 'conexion.php'; 
class DAOCarros
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
    
   
   
    public function Existe($id)
    {
        try 
        {
            $sql = "SELECT Usuario FROM estacionamiento WHERE Usuario = :id AND horaSalida IS NULL";
                    
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':id' => $id));
                       

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                
            if ($resultado) {
                $this->Salida($id);
                return true; // Si se encuentra un resultado, devuelve true
            } else {
               $this->Entrada($id);
                return false; // Si no se encuentra ningún resultado, devuelve false
            }
        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }

    public function Entrada($id)
    {
        $numeros=$_SESSION['espaciosc'];
        try 
        {
            $idEs=0;
            $p=1;            
            for ($i =0; $i <100; $i++) {
                $c=$numeros[$i];
                if($c==$p)
                {
                    $idEs=$numeros[$i];
                    $numeros[$i]=0;
                    break;
                }
                else
                {
                    $p++;
                }
                
            }
            $_SESSION['espaciosc']=$numeros;
            $horaEntrada= date('Y-m-d');
            $horaSalida=null;
            $Tipo="Alumno";
            $Tipo2="Automovil";
            $Estado=1;
            

            $id2=$id;
            $this->conexion->beginTransaction();

                // Obtener el IdEspacio
    

    // Insertar en la tabla espacio
    $sql_espacio = "INSERT INTO espacio (Tipo, Estado,UsEs, IdEspacio)
    VALUES (:Tipo, :Estado,:id,:idEs)";
    $stmt_espacio = $this->conexion->prepare($sql_espacio);

    $stmt_espacio->execute(array( ":Tipo" => $Tipo2, ":Estado" => $Estado,":id" => $id,":idEs" => $idEs));
// Insertar en la tabla estacionamiento
    $sql_estacionamiento = "INSERT INTO estacionamiento (tipoUsuario, horaEntrada, horaSalida, Usuario)
            VALUES (:tipoUsuario, :horaEntrada, :horaSalida, :Usuario)";
    $stmt_estacionamiento = $this->conexion->prepare($sql_estacionamiento);
    $stmt_estacionamiento->execute(array(':Usuario' => $id, ":tipoUsuario" => $Tipo, ":horaEntrada" => $horaEntrada, ":horaSalida" => $horaSalida));

    

    // Confirmar la transacción
    $this->conexion->commit();


        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }

    public function Salida($id)
    {
        $numeros=$_SESSION['espaciosc'];
        try 
        {
            $p=1;
            $c=$IdEs-$p;
            $numeros[$c]=$IdEs;
            $horaSalida=date('Y-m-d');
            $Estado2=0;
            $id2=$id;
            $this->conexion->beginTransaction();
            $IdEs = 0;
            $_SESSION['espacios']=$numeros;
    

     // Insertar en la tabla espacio
     $sql_espacio = "delete from espacio where UsEs=:Usuario";
     $stmt_espacio = $this->conexion->prepare($sql_espacio);
     $stmt_espacio->execute(array(':Usuario' => $id));

     // Insertar en la tabla estacionamiento
     $sql_estacionamiento = "UPDATE estacionamiento SET horaSalida = :horaSalida WHERE Usuario = :Usuario ";
     $stmt_estacionamiento = $this->conexion->prepare($sql_estacionamiento);
     $stmt_estacionamiento->execute(array(':Usuario' => $id,":horaSalida" => $horaSalida));

    // Obtener el IdEspacio
    

    // Confirmar la transacción
    $this->conexion->commit();


        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }
    public function ObtenerIdEs($id)
    {
        try 
        {
            $sql = "SELECT idEspacio FROM espacio WHERE UsEs = :id ";
                    
            $this->conectar();
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':id' => $id));
                       

            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                
            if ($resultado) {
                //$this->Salida($id);
                $espacio=$resultado;
                return $espacio; // Si se encuentra un resultado, devuelve true
            } else {
               //$this->Entrada($id);
                return false; // Si no se encuentra ningún resultado, devuelve false
            }
        } catch (Exception $e){
            exit($e->getMessage());
        } finally {
            // Cerrar conexión o realizar otras tareas de limpieza si es necesario
        }
    }
	
}