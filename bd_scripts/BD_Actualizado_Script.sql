create database sige;
use sige;

-- true: Carro y Alumno
create table Estacionamiento(
	id int primary key auto_increment not null,
    Nombre varchar(30) not null,
    AluProf bool default true not null,
    CarMot bool default true not null
);


-- true: ocupado y para discapacitados 
create table Espacio(
	id int primary key auto_increment not null,
    tipo bool default false not null,
    estado bool default false not null,
    id_Estacionamiento int not null,
	foreign key (id_Estacionamiento) references Estacionamiento(id)
);

-- true: moto sin discapacidad y alumno
create table Usuario(
	id int primary key auto_increment not null,
    usuario varchar(9) not null,
    nombre varchar(50) not null,
    contrasenia varchar(20) not null,
    veiculo bool default true not null,
    discapacidad bool default false not null,
    AluProf bool default true not null
);

create table Queja(
	id int primary key auto_increment not null,
    descripcion Text not null,
    estado enum('En espera', 'En revison', 'Solucionado') default 'En espera' not null,
    rutaFoto varchar(50),
    id_Ususario int not null,
    foreign key (id_Ususario) references Usuario(id)
);

create table EspUsuario(
	id_Espacio int not null,
    id_Usuario int not null,
    Entrada datetime not null,
    Salida datetime not null,
    foreign key (id_Espacio) references Espacio(id),
    foreign key (id_Usuario) references Usuario(id)
);


-- Incersion de datos:
-- Agregar registros a la tabla Estacionamiento
INSERT INTO Estacionamiento (Nombre, AluProf, CarMot) VALUES 
('Estacionamiento Norte', true, true),
('Estacionamiento Sur', false, true),
('Estacionamiento Este', true, false);

-- Agregar registros a la tabla Usuario
INSERT INTO Usuario (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf) VALUES 
('U12345678', 'Juan Pérez', 'password123', true, false, true),
('U87654321', 'Ana Gómez', 'pass456', false, true, false),
('U11223344', 'Carlos Ruiz', 'mysecret', true, false, true);

-- Agregar registros a la tabla Queja
INSERT INTO Queja (descripcion, estado, rutaFoto, id_Ususario) VALUES 
('Espacio ocupado por vehículo no autorizado', 'En espera', 'foto1.jpg', 1),
('La rampa para discapacitados está bloqueada', 'En revison', 'foto2.jpg', 2),
('Problemas con el acceso al estacionamiento sur', 'Solucionado', 'foto3.jpg', 3);

-- Agregar registros a la tabla EspUsuario
-- Reibe el num de espacio, el id de usuario, la fecha de entrada y la fecha de salida.
-- Revisar el update de la salida ya que no entra y sale a la misma hora, crear un UPDATE del mismo para llevar el control.
INSERT INTO EspUsuario (id_Espacio, id_Usuario, Entrada, Salida) VALUES 
(1, 1, '2024-11-06 08:30:00', '2024-11-06 12:00:00'),
(2, 2, '2024-11-06 09:00:00', '2024-11-06 11:30:00'),
(3, 3, '2024-11-06 10:00:00', '2024-11-06 14:00:00');

INSERT INTO Espacio (tipo, estado, id_Estacionamiento) VALUES 
(false, true, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),
(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),(false, false, 2),
(true, true, 3),(true, false, 3),(false, true, 3),(false, false, 3),(true, true, 3),(true, false, 3),(false, true, 3),(false, false, 3),(true, true, 3),(true, false, 3),(false, true, 3),(false, false, 3);

-- ############ SCRIPT SPRINT ORLANDO ############ --

-- Script para busqueda oprima de espacios libres
CREATE INDEX idx_estado ON Espacio (estado);

-- Script para busqueda de espacios libres de Alumnos
SELECT id as Num_Lugar, id_Estacionamiento as Num_Estacionamiento, tipo as Tipo
FROM Espacio
WHERE estado = false and tipo = false
LIMIT 10; -- Devolver los n lugares que esten libres.

-- Script para busqueda de espacios libres de Profesores
SELECT id as Num_Lugar, id_Estacionamiento as Num_Estacionamiento, tipo as Tipo
FROM Espacio
WHERE estado = false and tipo = true
LIMIT 10; -- Devolver los n lugares que esten libres.

SELECT * FROM Espacio;

SELECT id_Espacio, id_Usuario, Entrada, Salida from EspUsuario where id_espacio=1 and id_usuario=1;
UPDATE EspUsuario SET Salida = now() where id_espacio=1 and id_usuario=1; -- revisar la posibilidad de exportar los datos al finalizar el dia y borrar todo aque lugar que tenga una salida diferente a la predenterminada.