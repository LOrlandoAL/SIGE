document.addEventListener("DOMContentLoaded", function() {
    
    let id_Usuario;
let esAdministrador = false;

// Obtener la información del usuario mediante una solicitud AJAX
fetch('/SIGE/vista/getUserInfo.php')
    .then(response => response.json())
    .then(data => {
        if (data.id) {
            id_Usuario = data.id;
            esAdministrador = data.Administrador;
            loadQuejas(); // Cargar las quejas después de obtener la información del usuario
        } else {
            console.error('Error: No se pudo obtener la información del usuario:', data.error);
        }
    })
    .catch(error => console.error('Error al obtener la información del usuario:', error));

// Modificar la función loadQuejas para cargar las quejas de acuerdo al rol
function loadQuejas() {
    if (esAdministrador) {
        // Si el usuario es administrador, carga todas las quejas sin filtrar por usuario
        fetch(`/SIGE/vista/DaoQueja.php?action=get`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar las quejas');
                return response.json();
            })
            .then(data => {
                mostrarQuejas(data);
            })
            .catch(error => console.error('Error al cargar quejas:', error));
    } else {
        // Si el usuario no es administrador, carga solo las quejas del usuario
        fetch(`/SIGE/vista/DaoQueja.php?action=get&id_Usuario=${id_Usuario}`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar las quejas');
                return response.json();
            })
            .then(data => {
                mostrarQuejas(data);
            })
            .catch(error => console.error('Error al cargar quejas:', error));
    }
}

// Función para mostrar las quejas en la tabla
function mostrarQuejas(data) {
    const quejasTable = document.getElementById('quejasTable');
    quejasTable.innerHTML = '';
    data.forEach(queja => {
        quejasTable.innerHTML += `
            <tr>
                <td>${queja.id}</td>
                <td>${queja.descripcion}</td>
                <td>${queja.estado}</td>
                <td>
                    ${queja.rutaFoto ? `<img src="${queja.rutaFoto}" alt="Foto" width="100">` : 'N/A'}
                </td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="editQueja(${queja.id})">Editar</button>
                    <button class="btn btn-danger btn-sm" onclick="deleteQueja(${queja.id})">Eliminar</button>
                </td>
            </tr>
        `;
    });
}



    // Agregar o editar queja
    document.getElementById('quejaForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const id = document.getElementById('quejaId').value;
        const descripcion = document.getElementById('descripcion').value;
        const estado = document.getElementById('estado').value; // Captura el valor del estado seleccionado
        const rutaFotoInput = document.getElementById('rutaFoto');
        const rutaFotoFile = rutaFotoInput.files[0]; // Obtener el archivo
    
        const action = id ? 'update' : 'create';
        const url = `/SIGE/vista/DaoQueja.php?action=${action}`;
        const formData = new FormData();
        
        formData.append('id', id);
        formData.append('descripcion', descripcion);
        formData.append('estado', estado); // Asegúrate de que el estado seleccionado se envíe aquí
        
        // Si el usuario seleccionó un archivo, agregarlo al FormData
        if (rutaFotoFile) {
            formData.append('rutaFoto', rutaFotoFile);
        }
    
        // Define un valor temporal para id_Usuario (ajusta según tu lógica de aplicación)
         // Cambia a un valor dinámico si es necesario
        formData.append('id_Usuario', id_Usuario);
    
        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Error al guardar la queja');
            return response.json();
        })
        .then(responseData => {
            if (responseData.success) {
                $('#addQuejaModal').modal('hide');
                loadQuejas();
                document.getElementById('quejaForm').reset();
            } else {
                alert('Error al guardar la queja: ' + (responseData.message || ''));
            }
        })
        .catch(error => console.error('Error al guardar la queja:', error));
    });
    

    // Editar queja
    window.editQueja = function(id) {
        fetch(`/SIGE/vista/DaoQueja.php?action=get&id=${id}`)
            .then(response => {
                if (!response.ok) throw new Error('Error al cargar la queja');
                return response.json();
            })
            .then(data => {
                document.getElementById('quejaId').value = data.id;
                document.getElementById('descripcion').value = data.descripcion;
                document.getElementById('estado').value = data.estado;
                
                // No podemos previsualizar archivos en un campo file, así que dejamos vacío
                document.getElementById('rutaFoto').value = '';
                $('#addQuejaModal').modal('show');
            })
            .catch(error => console.error('Error al cargar la queja:', error));
    };

    // Eliminar queja
    window.deleteQueja = function(id) {
        if (confirm('¿Estás seguro de que deseas eliminar esta queja?')) {
            fetch(`/SIGE/vista/DaoQueja.php?action=delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id }) // Aseguramos enviar el id en el cuerpo de la solicitud
            })
            .then(response => {
                if (!response.ok) throw new Error('Error al eliminar la queja');
                return response.json();
            })
            .then(responseData => {
                if (responseData.success) {
                    loadQuejas();
                } else {
                    alert('Error al eliminar la queja: ' + (responseData.message || ''));
                }
            })
            .catch(error => console.error('Error al eliminar la queja:', error));
        }
    };
    
    
});
