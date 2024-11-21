<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Docentes</title>
    <link rel="stylesheet" href="css/Estilos.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        /* Estilo para la imagen de fondo en la sección derecha */
        .right-section {
            background-image: url('../imgs/Docentes.JPG'); /* Ruta de la imagen */
            background-size: cover; /* Ajustar la imagen para cubrir todo el fondo */
            background-position: center; /* Centrar la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
            min-height: 100%; /* Asegurar que cubra el espacio disponible */
        }
    </style>
</head>
<header>
    <div class="logo">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE">
    </div>
</header>

<body>
    <div class="container mt-5 d-flex">
        <!-- Sección izquierda con el formulario -->
        <div class="flex-grow-1 p-4">
            <form action="RegistroDocentes.php" method="POST" class="row g-3">
                <!-- Campo Nombre -->
                <div class="col-md-6">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" id="nombre" name="Nombre" class="form-control" placeholder="Ingrese el nombre completo" style="color: green;" required>
                </div>
                
                <!-- Campo Matrícula -->
                <div class="col-md-6">
                    <label for="matricula" class="form-label">Matrícula:</label>
                    <input type="text" id="matricula" name="Matricula" class="form-control" placeholder="Ingrese la matrícula" style="color: green;" required>
                </div>
                
                <!-- Campo Contraseña -->
                <div class="col-md-6">
                    <label for="contrasenia" class="form-label">Contraseña:</label>
                    <input type="password" id="contrasenia" name="contrasenia" class="form-control" placeholder="Ingrese una contraseña" style="color: green;" required>
                </div>

                <!-- Campo Carrera -->
                <div class="col-md-6">
                    <label for="carrera" class="form-label">Carrera:</label>
                    <select name="Carrera" id="carrera" class="form-select" style="color: green;" required>
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

                <!-- Campo Tipo de Vehículo -->
                <div class="col-md-6">
                    <label class="form-label">¿Tipo de vehículo?</label>
                    <div class="form-check">
                        <input type="radio" id="moto" name="veiculo" value="0" class="form-check-input">
                        <label for="moto" class="form-check-label" style="color: green;">Moto</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" id="carro" name="veiculo" value="1" class="form-check-input" checked>
                        <label for="carro" class="form-check-label" style="color: green;">Carro</label>
                    </div>
                </div>

                <!-- Campo Discapacidad -->
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

                <!-- Campos Ocultos -->
                <input type="hidden" name="AluProf" value="1">
                <input type="hidden" name="Semestre" value="Na">

                <!-- Botones -->
                <div class="col-12 d-flex justify-content-end">
                    <button type="button" onclick="window.location.href='index.php';" class="btn btn-secondary me-2">Cancelar</button>
                    <button type="submit" class="btn btn-success">Aceptar</button>
                </div>
            </form>
        </div>

        <!-- Sección derecha con la imagen -->
        <div class="right-section flex-shrink-1 col-md-4"></div>
    </div>

    <footer class="text-center mt-5">
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
