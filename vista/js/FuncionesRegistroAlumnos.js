document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('NuevoUsuario').addEventListener('sumbit', function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        var NombreAlumno = document.getElementById('nombre').value;
        var NoControl = document.getElementById('NoControl').value;
        var Carrera = document.getElementById('Carrera').value;
        var Semestre = document.getElementById('Semestre').value;
        varradio = document.getElementById('discapacidad')
        if (((Carrera !== null) ) && (Semestre !== null)
        && (NombreAlumno!=="") && (NoControl!=="") ) {
          alert("HOLa");
        } 
        else{

        }
    });
});
