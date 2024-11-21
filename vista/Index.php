<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - SIGE</title>
    <link rel="stylesheet" href="css/Estilos.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<header>
    <div class="logo text-center p-3">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE" class="img-fluid">
    </div>
</header>

<body>
    <div class="container mt-5 d-flex">
        <!-- Sección izquierda (imagen y tipo de usuario) -->
        <div class="left-section col-md-6 d-flex flex-column align-items-center">
            <img src="imgs/User.JPG" alt="Imagen de usuario" class="img-fluid mb-4" style="max-width: 100%; height: auto;">
            
            <!-- Selección de tipo de usuario -->
            <div class="w-75">
                <label for="TipoUsuario" class="form-label">Tipo de Usuario</label>
                <select id="TipoUsuario" name="TipoUsuario" class="form-select" style="color: green; border-color: green;" required>
                    <option value="alumno">Alumno</option>
                    <option value="docente">Docente</option>
                </select>
            </div>
        </div>

        <!-- Sección derecha (formulario) -->
        <div class="right-section col-md-6 p-4">
            <form action="ProcesarLogin.php" method="POST" class="border rounded p-4">
                <h3 class="text-center mb-4" style="color: green;">Inicio de Sesión</h3>
                
                <!-- Campo de usuario -->
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingresa tu usuario" required>
                </div>

                <!-- Campo de contraseña -->
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <input type="password" id="contrasena" name="contrasenia" class="form-control" placeholder="Ingresa tu contraseña" required>
                </div>

                <!-- Recuperar contraseña -->
                <div class="mb-3 text-center">
                    <a href="recuperarcontrasena.php" class="text-decoration-none" style="color: green; font-size: 1rem;">¿Olvidaste tu contraseña?</a>
                </div>

                <!-- Botón de enviar -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">Entrar</button>
                    <button type="button" id="registroBtn" class="btn btn-outline-success" style="background-color: white; color: green; border-color: green;">
                        Regístrate
                    </button>
                </div>
            </form>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Captura el evento del botón de registro
        document.getElementById('registroBtn').addEventListener('click', function () {
            const tipoUsuario = document.getElementById('TipoUsuario').value;
            
            // Redirige dependiendo del tipo de usuario seleccionado
            if (tipoUsuario === 'alumno') {
                window.location.href = 'Alumno.php';
            } else if (tipoUsuario === 'docente') {
                window.location.href = 'Docente.php';
            }
        });
    </script>
</body>
</html>
