<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumnos - SIGE</title>
    <link rel="stylesheet" href="css/Estilos.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Estilo para la imagen de fondo recortada */
        .right-section2 {
            flex: 1;
            background-image: url('../imgs/Alumnos.JPG'); /* Ruta de la imagen */
            background-size: 50% 100%; /* Recortar la imagen por la mitad */
            background-position: center right; /* Posicionar la imagen en el lado derecho */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .left-section2 {
            flex: 2;
            padding: 20px;
        }
    </style>
</head>
<header>
    <div class="logo">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE">
    </div>
</header>

<body>
    <div class="container mt-5 form-container">
        <!-- Sección izquierda con el formulario -->
        <div class="left-section2">
            <form action="RegistroAlumnos.php" id="NuevoUsuario" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre completo" style="color: green;" required>
                </div>
                
                <div class="col-md-6">
                    <label for="NoControl" class="form-label">N° de control:</label>
                    <input type="text" id="NoControl" name="NoControl" class="form-control" placeholder="Número de control" style="color: green;" maxlength="9" required>
                </div>

                <div class="col-md-6">
                    <label for="Carrera" class="form-label">Carrera:</label>
                    <select id="Carrera" name="carrera" class="form-select" style="color: green;">
                        <option value="Ingenieria en sistemas Computacionales">Ingeniería en Sistemas Computacionales</option>
                        <option value="Ingenieria en Sistemas Automotrices">Ingeniería en Sistemas Automotrices</option>
                        <option value="Ingenieria Ambiental">Ingeniería Ambiental</option>
                        <option value="Gastronomía">Gastronomía</option>
                        <option value="Gestión Empresarial">Gestión Empresarial</option>
                        <option value="Ingenieria en Microcontroladores">Ingeniería en Microcontroladores</option>
                        <option value="Ingenieria en Electronica">Ingeniería en Electrónica</option>
                        <option value="Ingenieria industrial">Ingeniería Industrial</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="Semestre" class="form-label">Semestre:</label>
                    <select id="Semestre" name="semestre" class="form-select" style="color: green;">
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
                </div>

                <div class="col-md-6">
                    <label class="form-label">¿Padeces alguna discapacidad?</label>
                    <div class="form-check">
                        <input type="radio" id="si" name="discapacidad" value="1" class="form-check-input">
                        <label for="si" class="form-check-label" style="color: green;">Sí</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="no" name="discapacidad" value="0" class="form-check-input" checked>
                        <label for="no" class="form-check-label" style="color: green;">No</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="veiculo" class="form-label">Tipo de vehículo:</label>
                    <select id="veiculo" name="veiculo" class="form-select" style="color: green;">
                        <option value="0">Carro</option>
                        <option value="1">Moto</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="contrasenia" class="form-label">Contraseña:</label>
                    <input type="password" id="contrasenia" name="contrasenia" class="form-control" placeholder="Contraseña" style="color: green;" required>
                </div>

                <!-- Campos ocultos -->
                <input type="hidden" name="AluProf" value="false">
                <input type="hidden" name="Administrador" value="false">

                <div class="col-12 d-flex justify-content-end">
                    <button type="button" onclick="window.location.href='index.php';" class="btn btn-secondary me-2">Cancelar</button>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </form>
        </div>

        <!-- Sección derecha con la imagen recortada -->
        <div class="right-section2"></div>
    </div>

    <footer>
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
