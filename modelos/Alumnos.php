<?php
class Alumnos {
    public $IdUsuarios;      // Número de control (identificador único del alumno)
    public $nombre;          // Nombre del alumno
    public $carrera;         // Carrera del alumno
    public $discapacidad;    // Indica si el alumno tiene discapacidad (1 para Sí, 0 para No)
    public $veiculo;         // Tipo de vehículo (true para carro, false para moto)
    public $AluProf;         // Tipo de usuario, fijo en false (indica que es alumno)
    public $semestre;        // Semestre en el que está el alumno
    public $contrasenia;     // Contraseña del alumno
}
?>
