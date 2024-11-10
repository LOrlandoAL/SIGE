<?php
/**
 * Clase que manejará la conexión a la BD
 */
class Conexion
{
    private static $conexion = null;

    public function __construct()
    {
        try {
            if (session_status() === PHP_SESSION_ACTIVE) {
                // La sesión ya está activa
            } else {
                session_start();
            }
            self::$conexion = new PDO("mysql:host=localhost;port=3306;dbname=sige", "root", "root");
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexion exitosa!";
        } catch (PDOException $e) {
            exit($e->getMessage());
            return false;
        }
        return self::$conexion;
    }

    /**
     * Método que permite cerrar la conexión a la base de datos
     */
    public function desconectar()
    {
        self::$conexion = null;
        session_destroy();
    }

    /**
     * Método que devuelve la conexión actual (para realizar operaciones directas si es necesario)
     */
    public static function obtenerConexion()
    {
        return self::$conexion;
    }
}
?>
