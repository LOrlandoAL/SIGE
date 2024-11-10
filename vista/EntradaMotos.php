<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página Web</title>
    <link rel="stylesheet" href="css/Estilos.css">
</head>
<header>
    <div class="logo">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE">
    </div>
</header>

<body>
<?php
// Verificamos si hay un mensaje pasado como parámetro GET
if(isset($_GET['mensaje'])) {
    // Decodificamos el mensaje
    $mensaje = urldecode($_GET['mensaje']);
    // Mostramos el mensaje utilizando JavaScript
    echo "<script>alert('$mensaje');</script>";
}
?>
    <div class="container">
        <div class="left-section">
            <img src="imgs/User.JPG" alt="Imagen izquierda">
                <form action="EntradaSalidaMotos.php" method="POST">
                        
                    
                                <div class="right-section">
                                    <label for="usuario">Usuario</label>
                                    <input type="text" id="usuario" name="usuario" required>
                                    <button>Entrar</button>
                                </div>
                            
                  </form>
     </div>
    <footer>
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>
    <script src="js/funciones.js"></script>
</body>
</html>
