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
    <form action="RegistroAlumnos.php" id="NuevoUsuario" method="POST">
        <div class="container2">
            <div class="left-section2">
                <label for="nombre">Nombre:</label>
                <input required type="text" id="nombre" name="Nombre" style="color: green;" >
                <br>
                <br>
                <label for="NoControl">N° de control:</label>
                <input  type="text" id="NoControl" name="NoControl" style="color: green;" required>
                <br>
                <label for="Carrera">Carrera:</label>
                <select id="Carrera" name="Carrera">
                    <option value="Sistemas_computacionales">Sistemas computacionales</option>
                    <option value="Automotriz">Automotriz</option>
                    <option value="Gestion_Empresarial">Gestion Empresarial</option>
                    <option value="Ambiental">Ambiental</option>
                </select>
                <br>
                <label for="semestre">Semestre:</label>
                <select id="Semestre" name="Semestre">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                </select>
                <br>
                <br>
                <label>Padeces alguna discapacidad?</label>
                <input type="radio" id="si" name="discapacidad" value="si" style="color: green;">
                <label for="si" style="color: green;">Sí</label>
                <input type="radio" id="no" name="discapacidad" value="no" style="color: green;">
                <label for="no" style="color: green;">No</label>
                <br><br>
                <label for="contrasenia">Contraseña</label>
                <input  type="text" id="contrasenia" name="contrasenia" style="color: green;" required>
                <br>
                <input type="text" value="Alumno" hidden name="Tipo">
                <input type="text" value="Na" hidden name="puesto">
                <button>Cancelar</button>
                <button>Aceptar</button>
            </div>
            <div class="right-section2">
                <!-- Lado derecho vacío por ahora -->
            </div>
        </div>
    </form>
<footer>
    <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
    <p>Todos los derechos reservados. 2024</p>
</footer>
<!--<script src="js/FuncionesRegistroAlumnos.js"></script>-->
</body>
</html>
