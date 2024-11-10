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

    <form action="RegistroDocentes.php" method="POST">  
        <div class="container2">
        <div class="left-section2">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="Nombre"style="color: green;">
            <br>
            <br>
            <label for="matricula">Matricula:</label>
            <input type="text" id="matricula" name="Matricula"style="color: green;">
            <br>
            <label for="contrasenia">Contraseña</label>
                <input  type="text" id="contrasenia" name="contrasenia" style="color: green;" required>
            <br>
            <label for="area">Área:</label>
            <select name="Area"id="area">
                <option value="1">Personal Docente</option>
                <option value="2">Automotriz</option>
                <option value="3">Gestion Empresarial</option>
                <option value="3">Ambiental</option>
            </select>
            <br>
            <br>
            <label for="puesto">Puesto:</label>
            <input type="text" id="puesto" name="Puesto" style="color: green;">
            <br>
            <br>
            <label>Padeces alguna discapacidad?</label>
            <input type="radio" id="si" name="discapacidad" value="si" style="color: green;">
            <label for="si" style="color: green;">Sí</label>
            <input type="radio" id="no" name="discapacidad" value="no" style="color: green;">
            <label for="no" style="color: green;">No</label>
            <br><br>
            <input type="text" value="Docente" hidden name="Tipo">
            <input type="text" value="Na" hidden name="Semestre">
            <button>Cancelar</button>
            <button>Aceptar</button>
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
