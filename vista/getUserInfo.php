<?php
require_once '../datos/conexion.php';
if (!isset($_SESSION)) {
    session_start();
}

class UserInfoFetcher {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::obtenerConexion();
    }

    public function getUserInfoByUsuario($usuario) {
        $stmt = $this->conn->prepare("SELECT id, Administrador FROM Usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$usuario = $_SESSION['us'] ?? null;

if ($usuario) {
    $fetcher = new UserInfoFetcher();
    $userInfo = $fetcher->getUserInfoByUsuario($usuario);
    echo json_encode($userInfo);
} else {
    echo json_encode(['error' => 'Usuario no encontrado en la sesión']);
}
