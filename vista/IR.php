<?php
if (session_status() === PHP_SESSION_ACTIVE) {
     
}  else {
    
    session_start();
    $espacios = range(1, 100);
    $_SESSION['espacios'] = $espacios;
}
header("Location: EntradaMotos.php");
?>