<?php
// Importa la clase conexión y el modelo para usarlos
require_once 'conexion.php'; 

class DAOCarros
{
    private $conexion; 

    private function conectar(){
        try {
            $Con = new Conexion();
            $this->conexion = $Con::obtenerConexion();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function Existe($usuario) {
        try {
            // Obtener el ID del usuario a partir del número de control (usuario)
            $sql_get_id = "SELECT id FROM Usuarios WHERE usuario = :usuario";
            $this->conectar();
            $stmt_get_id = $this->conexion->prepare($sql_get_id);
            $stmt_get_id->execute(array(':usuario' => $usuario));
            $result = $stmt_get_id->fetch(PDO::FETCH_ASSOC);
            
            if (!$result) {
                throw new Exception("Usuario no encontrado.");
            }

            $id = $result['id'];

            $sql = "SELECT id_Usuario FROM EspUsuario WHERE id_Usuario = :id AND Salida = '2024-01-01 00:00:00'";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':id' => $id));
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                
            if ($resultado) {
                $this->Salida($id);
                return true; 
            } else {
               $this->Entrada($id);
                return false;
            }
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function ObtenerIdEs($idUsuario) {
        try {
            $sql = "SELECT id_Espacio FROM EspUsuario WHERE id_Usuario = :idUsuario AND Salida = '2024-01-01 00:00:00'";
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute(array(':idUsuario' => $idUsuario));
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado ? $resultado : null;
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

    public function Entrada($id) {
        $numeros = $_SESSION['espaciosc'];
        try {
            // Iniciar transacción
            $this->conexion->beginTransaction();

            // Obtener espacio disponible
            $idEspacio = 0;
            for ($i = 0; $i < 100; $i++) {
                if ($numeros[$i] == 1) {
                    $idEspacio = $numeros[$i];
                    $numeros[$i] = 0;
                    break;
                }
            }
            $_SESSION['espaciosc'] = $numeros;

            $horaEntrada = date('Y-m-d H:i:s');
            $tipoUsuario = false;
            $tipoAuto = false;
            $estadoOcupado = 1; // Estado ocupado (1)

            // Insertar en la tabla EspUsuario
            $sql_esp_usuario = "INSERT INTO EspUsuario (id_Espacio, id_Usuario, Entrada) 
                                VALUES (:idEspacio, :idUsuario, :horaEntrada)";
            $stmt_esp_usuario = $this->conexion->prepare($sql_esp_usuario);
            $stmt_esp_usuario->execute(array(
                ':idEspacio' => $idEspacio,
                ':idUsuario' => $id,
                ':horaEntrada' => $horaEntrada
            ));

            // Insertar en la tabla Estacionamiento
            $sql_estacionamiento = "INSERT INTO estacionamiento (Nombre, AluProf, CarMot, horaEntrada, Usuario)
                                    VALUES (:nombre, :AluProf, :CarMot, :horaEntrada, :Usuario)";
            $stmt_estacionamiento = $this->conexion->prepare($sql_estacionamiento);
            $stmt_estacionamiento->execute(array(
                ':Usuario' => $id,
                ':nombre' => $tipoUsuario,
                ':AluProf' => $tipoUsuario,
                ':CarMot' => $tipoAuto,
                ':horaEntrada' => $horaEntrada
            ));

            // Marcar el espacio como ocupado en la tabla Espacio
            $sql_ocupar_espacio = "UPDATE espacio SET estado = :estado WHERE id = :id";
            $stmt_ocupar_espacio = $this->conexion->prepare($sql_ocupar_espacio);
            $stmt_ocupar_espacio->execute(array(
                ':estado' => $estadoOcupado,
                ':id' => $idEspacio
            ));

            // Confirmar la transacción
            $this->conexion->commit();
        } catch (Exception $e) {
            $this->conexion->rollBack();
            exit($e->getMessage());
        }
    }

    public function Salida($id) {
        try {
            // Iniciar transacción
            $this->conexion->beginTransaction();
            $horaSalida = date('Y-m-d H:i:s');
            
            // Obtener el id del espacio asignado al usuario
            $sql_obtener_espacio = "SELECT id_Espacio FROM EspUsuario WHERE id_Usuario = :idUsuario AND Salida = '2024-01-01 00:00:00'";
            $stmt_obtener = $this->conexion->prepare($sql_obtener_espacio);
            $stmt_obtener->execute(array(':idUsuario' => $id));
            $espacio_usuario = $stmt_obtener->fetch(PDO::FETCH_ASSOC);
            
            if (!$espacio_usuario) {
                throw new Exception("No se encontró un espacio asignado para el usuario");
            }
            
            $idEspacio = $espacio_usuario['id_Espacio'];
            $estadoLibre = 0; // Estado libre (0)
            
            // Marcar el espacio como libre
            $sql_liberar_espacio = "UPDATE espacio SET estado = :estado WHERE id = :id";
            $stmt_liberar = $this->conexion->prepare($sql_liberar_espacio);
            $stmt_liberar->execute(array(':estado' => $estadoLibre, ':id' => $idEspacio));
            
            // Registrar hora de salida en EspUsuario
            $sql_esp_usuario_salida = "UPDATE EspUsuario SET Salida = :horaSalida WHERE id_Usuario = :idUsuario AND id_Espacio = :idEspacio AND Salida = '2024-01-01 00:00:00'";
            $stmt_esp_usuario_salida = $this->conexion->prepare($sql_esp_usuario_salida);
            $stmt_esp_usuario_salida->execute(array(':horaSalida' => $horaSalida, ':idUsuario' => $id, ':idEspacio' => $idEspacio));
            
            // Confirmar la transacción
            $this->conexion->commit();
        } catch (Exception $e) {
            $this->conexion->rollBack();
            exit($e->getMessage());
        }
    }
}
?>
