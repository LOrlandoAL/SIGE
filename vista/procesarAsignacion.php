<?php
require_once '../datos/DAOAsignarEspacio.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $dao = new EspacioDAO();
    $mensaje = $dao->asignarOActualizarEspacio($usuario);

    // Redirigir de vuelta a la página con el mensaje
    header("Location: EntradaGuardia.php?mensaje=" . urlencode($mensaje));
    exit;
}
?>
