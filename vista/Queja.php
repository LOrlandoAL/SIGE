<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Quejas - SIGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestión de Quejas</h2>
        
        <!-- Botón para agregar nueva queja -->
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addQuejaModal">Agregar Queja</button>
        
        <!-- Tabla para mostrar quejas -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Ruta Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="quejasTable">
                <!-- Aquí se insertarán las quejas dinámicamente usando JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar/editar queja -->
    <div class="modal fade" id="addQuejaModal" tabindex="-1" aria-labelledby="addQuejaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQuejaModalLabel">Agregar Queja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="quejaForm" enctype="multipart/form-data">
    <input type="hidden" id="quejaId">
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" id="estado" required>
            <option value="En espera">En espera</option>
            <option value="En revision">En revisión</option>
            <option value="Solucionado">Solucionado</option>
        </select>
    </div>
    <div class="form-group">
        <label for="rutaFoto">Subir Foto</label>
        <input type="file" class="form-control" id="rutaFoto" name="rutaFoto" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/queja.js"></script>


</body>
</html>
