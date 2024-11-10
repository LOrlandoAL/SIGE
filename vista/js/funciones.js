document.addEventListener('DOMContentLoaded', () => {
   
    document.getElementById('Registro').addEventListener('click', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        var tipoUsuario = document.getElementById('TipoUsuario').value;
        if (tipoUsuario === 'alumno') {
            window.location.href = 'Alumno.php';
        } else if (tipoUsuario === 'docente') {
            window.location.href = 'Docente.php';
        } 
    });
    
});
