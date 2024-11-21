<?php
require_once 'Conexion.php';

class EspacioDAO
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::obtenerConexion();
    }

    public function asignarOActualizarEspacio($usuario)
    {
        try {
            // Verificar si el usuario ya tiene un espacio asignado y no ha registrado salida
            $queryVerificar = "
                SELECT EU.id_Espacio, E.id_Estacionamiento, Est.Nombre AS NombreEstacionamiento
                FROM EspUsuario EU
                INNER JOIN Espacio E ON EU.id_Espacio = E.id
                INNER JOIN Estacionamiento Est ON E.id_Estacionamiento = Est.id
                WHERE EU.id_Usuario = (
                    SELECT id FROM Usuarios WHERE usuario = :usuario
                ) AND EU.Salida IS NULL
                LIMIT 1";

            $stmt = $this->conexion->prepare($queryVerificar);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                // Si se encuentra, actualizamos la salida y el estado del espacio
                $idEspacio = $resultado['id_Espacio'];
                $nombreEstacionamiento = $resultado['NombreEstacionamiento'];

                // Actualizar salida
                $queryActualizarSalida = "
                    UPDATE EspUsuario 
                    SET Salida = NOW() 
                    WHERE id_Espacio = :idEspacio 
                    AND id_Usuario = (
                        SELECT id FROM Usuarios WHERE usuario = :usuario
                    ) AND Salida IS NULL";

                $stmt = $this->conexion->prepare($queryActualizarSalida);
                $stmt->bindParam(':idEspacio', $idEspacio);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->execute();

                // Cambiar estado del espacio a desocupado
                $queryDesocupar = "UPDATE Espacio SET estado = 0 WHERE id = :idEspacio";
                $stmt = $this->conexion->prepare($queryDesocupar);
                $stmt->bindParam(':idEspacio', $idEspacio);
                $stmt->execute();

                return "Salida registrada exitosamente. Espacio ID $idEspacio del estacionamiento '$nombreEstacionamiento' ahora está desocupado.";
            } else {
                // Si no se encuentra, procedemos a asignar un espacio
                return $this->asignarEspacio($usuario);
            }
        } catch (PDOException $e) {
            return "Error al procesar: " . $e->getMessage();
        }
    }

    private function asignarEspacio($usuario)
    {
        try {
            // Obtener datos del usuario
            $queryUsuario = "SELECT * FROM Usuarios WHERE usuario = :usuario";
            $stmt = $this->conexion->prepare($queryUsuario);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return "Usuario no encontrado.";
            }

            $datosUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

            $tipoVehiculo = $datosUsuario['veiculo']; // true: carro, false: moto
            $discapacidad = $datosUsuario['discapacidad'];
            $aluProf = $datosUsuario['AluProf']; // true: profesor, false: alumno

            // Buscar un espacio disponible según los criterios y el tipo de estacionamiento
            $queryEspacio = "
                SELECT E.*, Est.Nombre AS NombreEstacionamiento 
                FROM Espacio E
                INNER JOIN Estacionamiento Est ON E.id_Estacionamiento = Est.id
                WHERE E.estado = 0 
                AND E.tipo = :tipo 
                AND E.id_Estacionamiento % 2 = :paridad
                AND Est.AluProf = :aluProf
                LIMIT 1";

            $tipo = $discapacidad ? 1 : 0;
            $paridad = $tipoVehiculo ? 0 : 1; // 0: carro (pares), 1: moto (impares)

            $stmt = $this->conexion->prepare($queryEspacio);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_BOOL);
            $stmt->bindParam(':paridad', $paridad, PDO::PARAM_INT);
            $stmt->bindParam(':aluProf', $aluProf, PDO::PARAM_BOOL);
            $stmt->execute();

            if ($stmt->rowCount() === 0) {
                return "No hay espacios disponibles para este usuario.";
            }

            $espacio = $stmt->fetch(PDO::FETCH_ASSOC);

            // Asignar el espacio al usuario
            $queryAsignacion = "
                INSERT INTO EspUsuario (id_Espacio, id_Usuario, Entrada) 
                VALUES (:idEspacio, :idUsuario, NOW())";
            $stmt = $this->conexion->prepare($queryAsignacion);
            $stmt->bindParam(':idEspacio', $espacio['id']);
            $stmt->bindParam(':idUsuario', $datosUsuario['id']);
            $stmt->execute();

            // Actualizar el estado del espacio
            $queryUpdate = "UPDATE Espacio SET estado = 1 WHERE id = :idEspacio";
            $stmt = $this->conexion->prepare($queryUpdate);
            $stmt->bindParam(':idEspacio', $espacio['id']);
            $stmt->execute();

            $nombreEstacionamiento = $espacio['NombreEstacionamiento'];
            return "Espacio asignado con éxito: Espacio ID " . $espacio['id'] . " en el estacionamiento '$nombreEstacionamiento'.";
        } catch (PDOException $e) {
            return "Error en la asignación: " . $e->getMessage();
        }
    }
}
?>
