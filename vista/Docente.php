<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Docentes</title>
    <link rel="stylesheet" href="css/Estilos.css">
</head>
<header>
    <div class="logo">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE">
    </div>
</header>

<body>
    <form action="RegistroDocentes.php" method="POST">  
        <div class="container2">
            <div class="left-section2">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="Nombre" style="color: green;" required>
                <br><br>
                
                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="Matricula" style="color: green;" required>
                <br><br>

                <label for="contrasenia">Contraseña</label>
                <input type="password" id="contrasenia" name="contrasenia" style="color: green;" required>
                <br><br>
                
                <label for="carrera">Carrera:</label>
                <select name="Carrera" id="carrera" required>
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

                <label>¿Tipo de vehículo?</label>
                <input type="radio" id="moto" name="veiculo" value="0" style="color: green;">
                <label for="moto" style="color: green;">Moto</label>
                <input type="radio" id="carro" name="veiculo" value="1" style="color: green;" checked>
                <label for="carro" style="color: green;">Carro</label>
                <br><br>

                <label>¿Padeces alguna discapacidad?</label>
                <input type="radio" id="si" name="discapacidad" value="1" style="color: green;">
                <label for="si" style="color: green;">Sí</label>
                <input type="radio" id="no" name="discapacidad" value="0" style="color: green;" checked>
                <label for="no" style="color: green;">No</label>
                <br><br>
                
                <!-- Campos ocultos para el rol de docente -->
                <input type="text" value="1" hidden name="AluProf">
                <input type="text" value="Na" hidden name="Semestre">
                
                <button type="reset">Cancelar</button>
                <button type="submit">Aceptar</button>
            </div>
            <div class="right-section3">
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
