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

    <div class="container">
        <div class="left-section">
            <img src="imgs/User.JPG" alt="Imagen izquierda">
        <form action="ProcesarLogin.php" method="POST">
                        <select id="TipoUsuario">
                            <option value="alumno">Alumno</option>
                            <option value="docente">Docente</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                    <div class="right-section">
                        <label for="usuario">Usuario</label>
                        <input type="text" id="usuario" name="usuario" required>
                        <label for="contrasena">Contraseña</label>
                        <input  required type="password" id="contrasena" name="contrasenia">
                        <a href="Restaurarcontra.html">¿Olvidaste tu contraseña?</a>
                        <br>
                        <label for="Registro">¿No tienes una cuenta?</label><a href="" id="Registro"> Registrate</a>
                        <br>
                        <button>Entrar</button>
                    </div>
                </div>
         </form>
<footer>
    <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
    <p>Todos los derechos reservados. 2024</p>
</footer>
<script src="js/funciones.js"></script>
</body>
</html>
