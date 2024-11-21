<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estacionamiento</title>
    <link rel="stylesheet" href="css/Estilos.css">
    <!-- Enlace a Bootstrap para estilos y funcionalidad del modal -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<header>
    <div class="logo">
        <img src="imgs/SIGE.JPG" alt="Logo SIGE">
    </div>
</header>

<body>
    <!-- Modal -->
    <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mensajeModalLabel">
                        <?php
                        // Extraer título del mensaje si está presente
                        if (isset($_GET['mensaje'])) {
                            $mensaje = urldecode($_GET['mensaje']);
                            if (strpos($mensaje, "registrada exitosamente") !== false) {
                                echo "Liberación de Espacio";
                            } elseif (strpos($mensaje, "asignado con éxito") !== false) {
                                echo "Asignación de Espacio";
                            } else {
                                echo "Información";
                            }
                        }
                        ?>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php
                    // Extraer el nombre del estacionamiento y el ID del espacio
                    if (isset($_GET['mensaje'])) {
                        $mensaje = urldecode($_GET['mensaje']);

                        // Extraer ID del espacio
                        preg_match("/Espacio ID (\d+)/", $mensaje, $matchEspacio);
                        $idEspacio = $matchEspacio[1] ?? "No especificado";

                        // Extraer nombre del estacionamiento
                        preg_match("/estacionamiento '([^']+)'/", $mensaje, $matchEstacionamiento);
                        $nombreEstacionamiento = $matchEstacionamiento[1] ?? "Desconocido";

                        echo "Numero de Espacio: " . htmlspecialchars($idEspacio) . "<br>";
                        echo "Nombre del Estacionamiento: " . htmlspecialchars($nombreEstacionamiento);
                    } else {
                        echo "No hay información adicional disponible.";
                    }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="aceptarModalButton">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="left-section">
            <img src="imgs/User.JPG" alt="Imagen izquierda">
            <form action="procesarAsignacion.php" method="POST">
                <div class="right-section">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" required>
                    <button type="submit" class="btn btn-success">Asignar Espacio</button>
                </div>
            </form>
        </div>
    </div>
    
    <footer>
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>
    
    <!-- Enlace a Bootstrap JS para funcionalidad del modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mostrar el modal automáticamente si hay un mensaje
        <?php if (isset($_GET['mensaje'])): ?>
        var modal = new bootstrap.Modal(document.getElementById('mensajeModal'));
        modal.show();
        <?php endif; ?>

        // Recargar la página al dar clic en "Aceptar" y cerrar el modal
        document.getElementById('aceptarModalButton').addEventListener('click', function () {
            modal.hide(); // Ocultar el modal
            // Recargar la página sin parámetros de URL
            window.location.href = window.location.pathname;
        });
    </script>
</body>
</html>
