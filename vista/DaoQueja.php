<?php
// Muestra errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../datos/conexion.php';

class DaoQueja {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::obtenerConexion();
        if ($this->conn === null) {
            die("Error: No se pudo establecer la conexión a la base de datos.");
        }
    }
    

    // Función para crear una nueva queja
    public function createQueja($descripcion, $rutaFoto, $id_Usuario) {
        $stmt = $this->conn->prepare("INSERT INTO Queja (descripcion, rutaFoto, id_Ususario) VALUES (:descripcion, :rutaFoto, :id_Usuario)");
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':rutaFoto', $rutaFoto, PDO::PARAM_STR);
        $stmt->bindParam(':id_Usuario', $id_Usuario, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    // Función para actualizar una queja existente
    public function updateQueja($id, $descripcion, $estado, $rutaFoto = null) {
        if ($rutaFoto) {
            $stmt = $this->conn->prepare("UPDATE Queja SET descripcion = :descripcion, estado = :estado, rutaFoto = :rutaFoto WHERE id = :id");
            $stmt->bindParam(':rutaFoto', $rutaFoto, PDO::PARAM_STR);
        } else {
            $stmt = $this->conn->prepare("UPDATE Queja SET descripcion = :descripcion, estado = :estado WHERE id = :id");
        }
        $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
        $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    

    // Función para obtener todas las quejas o una queja específica por ID
    public function getQuejas($id = null) {
        if ($id) {
            $stmt = $this->conn->prepare("SELECT * FROM Queja WHERE id = ?");
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $this->conn->query("SELECT * FROM Queja");
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Utilizamos fetchAll con PDO
        }
    }
    

    // Función para eliminar una queja
    public function deleteQueja($id) {
        $stmt = $this->conn->prepare("DELETE FROM Queja WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

// Controlador para manejar las solicitudes AJAX
$action = $_GET['action'] ?? '';

$daoQueja = new DaoQueja();

switch ($action) {
    case 'get':
        $id = $_GET['id'] ?? null;
        $result = $daoQueja->getQuejas($id);
        echo json_encode($result);
        break;

    case 'create':
        $descripcion = $_POST['descripcion'] ?? '';
        $rutaFoto = null;
        $id_Usuario = $_POST['id_Usuario'] ?? null;

        // Manejar el archivo subido
        if (isset($_FILES['rutaFoto']) && $_FILES['rutaFoto']['error'] == UPLOAD_ERR_OK) {
            $nombreArchivo = $_FILES['rutaFoto']['name'];
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $rutaDestino = 'uploads/' . uniqid() . '.' . $extension;
    
            if (move_uploaded_file($_FILES['rutaFoto']['tmp_name'], $rutaDestino)) {
                $rutaFoto = $rutaDestino;
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al mover el archivo']);
                exit;
            }
        }
    
        $result = $daoQueja->createQueja($descripcion, $rutaFoto, $id_Usuario);
        echo json_encode(['success' => $result]);
        exit;

        case 'update':
            $id = $_POST['id'] ?? null;
            $descripcion = $_POST['descripcion'] ?? '';
            $estado = $_POST['estado'] ?? 'En espera';
            $rutaFoto = null;
        
            // Verifica si el ID fue proporcionado
            if ($id === null) {
                echo json_encode(['success' => false, 'message' => 'ID de la queja no proporcionado']);
                exit;
            }
        
            // Manejar el archivo subido si existe
            if (isset($_FILES['rutaFoto']) && $_FILES['rutaFoto']['error'] == UPLOAD_ERR_OK) {
                $nombreArchivo = $_FILES['rutaFoto']['name'];
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $rutaDestino = 'uploads/' . uniqid() . '.' . $extension;
        
                if (move_uploaded_file($_FILES['rutaFoto']['tmp_name'], $rutaDestino)) {
                    $rutaFoto = $rutaDestino;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error al mover el archivo']);
                    exit;
                }
            }
        
            // Llama al método updateQueja con todos los parámetros necesarios
            $result = $daoQueja->updateQueja($id, $descripcion, $estado, $rutaFoto);
            echo json_encode(['success' => $result]);
            exit;
        
        

        case 'delete':
            $input = json_decode(file_get_contents("php://input"), true);
            $id = $input['id'] ?? null;
            if ($id === null) {
                echo json_encode(['success' => false, 'message' => 'ID de la queja no proporcionado']);
                exit;
            }
        
            $result = $daoQueja->deleteQueja($id);
            echo json_encode(['success' => $result]);
            exit;
        
        
}
?>
