drop database sige;
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
CREATE TABLE Usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    usuario VARCHAR(9) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    contrasenia CHAR(64) NOT NULL,
    veiculo BOOL DEFAULT true NOT NULL,
    discapacidad BOOL DEFAULT false NOT NULL,
    AluProf BOOL DEFAULT true NOT NULL,
    carrera ENUM(
        'Ingenieria en sistemas Computacionales',
        'Ingenieria en Sistemas Automotrices',
        'Ingenieria Ambiental',
        'Gastronomía',
        'Gestión Empresarial',
        'Ingenieria en Microcontroladores',
        'Ingenieria en Electronica',
        'Ingenieria industrial'
    ) DEFAULT 'Ingenieria en sistemas Computacionales' NOT NULL,
    semestre TINYINT NOT NULL CHECK (semestre BETWEEN 1 AND 9),
    Administrador bool not null default false
);




create table Queja(
	id int primary key auto_increment not null,
    descripcion Text not null,
    estado enum('En espera', 'En revision', 'Solucionado') default 'En espera' not null,
    rutaFoto varchar(50),
    id_Ususario int not null,
    foreign key (id_Ususario) references Usuarios(id)
);

create table EspUsuario(
	id_Espacio int not null,
    id_Usuario int not null,
    Entrada datetime not null,
    Salida datetime not null,
    foreign key (id_Espacio) references Espacio(id),
    foreign key (id_Usuario) references Usuarios(id)
);


-- Incersion de datos:
-- Agregar registros a la tabla Estacionamiento
INSERT INTO Estacionamiento (Nombre, AluProf, CarMot) VALUES 
('Estacionamiento N Carro ', false, false);

-- Agregar registros a la tabla Usuario
INSERT INTO Usuarios (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf, carrera, semestre, Administrador) VALUES 
('S21120218', 'Luis Orlando', SHA2('OrlandoAL1234', 224), true, false, false, 'Ingenieria en sistemas Computacionales', 7, true);
SELECT usuario, contrasenia FROM Usuarios WHERE usuario = 'S21120218' AND contrasenia = SHA2('OrlandoAL1234', 224);

INSERT INTO Usuarios (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf, carrera, semestre, Administrador) VALUES 
('S21120181', 'Ian Rodolfo', SHA2('1223334444', 224), true, false, false, 'Ingenieria en sistemas Computacionales', 7, false);


-- Agregar registros a la tabla Queja
INSERT INTO Queja (descripcion, estado, rutaFoto, id_Ususario) VALUES 
('Espacio ocupado por vehículo no autorizado', 'En espera', 'foto1.jpg', 1),
('La rampa para discapacitados está bloqueada', 'En revison', 'foto2.jpg', 2),
('Problemas con el acceso al estacionamiento sur', 'Solucionado', 'foto3.jpg', 3);

-- Agregar registros a la tabla EspUsuario
-- Reibe el num de espacio, el id de usuario, la fecha de entrada y la fecha de salida.
-- Revisar el update de la salida ya que no entra y sale a la misma hora, crear un UPDATE del mismo para llevar el control.
INSERT INTO EspUsuario (id_Espacio, id_Usuario, Entrada, Salida) VALUES 
(1, 1, '2024-11-06 08:30:00', '2024-01-01 00:00:00');

INSERT INTO Espacio (tipo, estado, id_Estacionamiento) VALUES 
(false, false, 1);

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

SELECT * FROM usuarios;
SELECT * FROM Espacio;
SELECT * FROM estacionamiento;
SELECT * FROM EspUsuario;

SELECT AluProf FROM Usuarios WHERE usuario = 'S21120218';
SELECT id_Usuario FROM EspUsuario WHERE id_Usuario = 'S21120218' AND Salida = '2024-01-01 00:00:00';
SELECT id_Usuario FROM EspUsuario WHERE id_Usuario = '1' AND Salida = '2024-01-01 00:00:00';
ALTER TABLE EspUsuario MODIFY COLUMN Salida DATETIME DEFAULT '2024-01-01 00:00:00';



SELECT id_Espacio, id_Usuario, Entrada, Salida from EspUsuario where id_espacio=1 and id_usuario=1;
UPDATE EspUsuario SET Salida = now() where id_espacio=1 and id_usuario=1; -- revisar la posibilidad de exportar los datos al finalizar el dia y borrar todo aque lugar que tenga una salida diferente a la predenterminada.