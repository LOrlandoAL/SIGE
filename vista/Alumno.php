<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos - SIGE</title>
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
                <input required type="text" id="nombre" name="nombre" style="color: green;">
                <br><br>
                
                <label for="NoControl">N° de control:</label>
                <input type="text" id="NoControl" name="NoControl" style="color: green;" required>
                <br><br>
                
                <label for="Carrera">Carrera:</label>
                <select id="Carrera" name="carrera">
                    <option value="Ingenieria en sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                    <option value="Ingenieria en Sistemas Automotrices">Ingeniería en Sistemas Automotrices</option>
                    <option value="Ingenieria Ambiental">Ingeniería Ambiental</option>
                    <option value="Gastronomía">Gastronomía</option>
                    <option value="Gestión Empresarial">Gestión Empresarial</option>
                    <option value="Ingenieria en Microcontroladores">Ingeniería en Microcontroladores</option>
                    <option value="Ingenieria en Electronica">Ingeniería en Electrónica</option>
                    <option value="Ingenieria industrial">Ingeniería Industrial</option>
                </select>
                <br><br>
                
                <label for="semestre">Semestre:</label>
                <select id="Semestre" name="semestre">
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
                <br><br>
                
                <label>¿Padeces alguna discapacidad?</label>
                <input type="radio" id="si" name="discapacidad" value="1" style="color: green;">
                <label for="si" style="color: green;">Sí</label>
                <input type="radio" id="no" name="discapacidad" value="0" style="color: green;">
                <label for="no" style="color: green;">No</label>
                <br><br>
                
                <label for="contrasenia">Contraseña:</label>
                <input type="password" id="contrasenia" name="contrasenia" style="color: green;" required>
                <br><br>
                
                <input type="hidden" name="Tipo" value="Alumno">
                <input type="hidden" name="puesto" value="N/A">
                <input type="hidden" name="AluProf" value="false">
                
                <button type="button" onclick="window.location.href='index.php';">Cancelar</button>
                <button type="submit">Aceptar</button>
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
</body>
</html>
