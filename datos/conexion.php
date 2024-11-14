<?php
/**
 * Clase que manejará la conexión a la BD
 */
class Conexion
{
    private static $conexion = null;

    private static function conectar() {
        try {
            if (self::$conexion === null) {
                self::$conexion = new PDO("mysql:host=localhost;port=3306;dbname=sige", "root", "root");
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
        } catch (PDOException $e) {
            exit("Error en la conexión: " . $e->getMessage());
        }
    }

    /**
     * Método que devuelve la conexión actual (para realizar operaciones directas si es necesario)
     */
    public static function obtenerConexion()
    {
        if (self::$conexion === null) {
            self::conectar();
        }
        return self::$conexion;
    }

    /**
     * Método que permite cerrar la conexión a la base de datos
     */
    public static function desconectar()
    {
        self::$conexion = null;
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
}
?>
