<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Estacionamiento</title>
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
    <!-- Modal -->
    <div class="modal fade" id="mensajeModal" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mensajeModalLabel">
                        <?php
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
                    if (isset($_GET['mensaje'])) {
                        $mensaje = urldecode($_GET['mensaje']);

                        preg_match("/Espacio ID (\d+)/", $mensaje, $matchEspacio);
                        $idEspacio = $matchEspacio[1] ?? "No especificado";

                        preg_match("/estacionamiento '([^']+)'/", $mensaje, $matchEstacionamiento);
                        $nombreEstacionamiento = $matchEstacionamiento[1] ?? "Desconocido";

                        echo "Número de Espacio: " . htmlspecialchars($idEspacio) . "<br>";
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

    <!-- Contenedor principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Imagen en la parte superior -->
            <div class="col-12 text-center mb-4">
                <img src="imgs/User.JPG" alt="Imagen usuario" class="img-fluid rounded" style="max-width: 200px;">
            </div>

            <!-- Formulario debajo de la imagen -->
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h5 class="card-title text-center mb-4" style="color: green;">Control de Entrada</h5>
                    <form action="procesarAsignacion.php" method="POST">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ingrese el usuario" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Asignar Espacio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-5">
        <p>Instituto Tecnológico Superior del Sur de Guanajuato</p>
        <p>Todos los derechos reservados. 2024</p>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar el modal automáticamente si hay un mensaje
        <?php if (isset($_GET['mensaje'])): ?>
        var modal = new bootstrap.Modal(document.getElementById('mensajeModal'));
        modal.show();
        <?php endif; ?>

        // Recargar la página al dar clic en "Aceptar" y cerrar el modal
        document.getElementById('aceptarModalButton').addEventListener('click', function () {
            window.location.href = window.location.pathname;
        });
    </script>
</body>
</html>
