create database sige;
use sige;

-- FALSE: ALUMNO Y CARRO; TRUE: PROFESOR Y MOTO
create table Estacionamiento(
	id int primary key auto_increment not null,
    Nombre varchar(30) not null,
    AluProf bool default true not null,
    CarMot bool default true not null
);


-- TRUE: OCUPADO Y LUGAR DISCAPACITADOS
create table Espacio(
	id int primary key auto_increment not null,
    tipo bool default false not null,
    estado bool default false not null,
    id_Estacionamiento int not null,
	foreign key (id_Estacionamiento) references Estacionamiento(id)
);

-- TRUE: MOTO, NO LUGAR PARA DISCAPACITADOS Y PROFESOR
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
    ) DEFAULT Null ,
    semestre TINYINT CHECK (semestre BETWEEN 1 AND 9),
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
    Salida datetime,
    foreign key (id_Espacio) references Espacio(id),
    foreign key (id_Usuario) references Usuarios(id)
);

-- Incersion de datos:
-- Agregar registros a la tabla Estacionamiento
INSERT INTO Estacionamiento (Nombre, AluProf, CarMot) VALUES 
('Estacionamiento Norte AlCar ', false, false),
('Estacionamiento Norte AlMo ', false, true),
('Estacionamiento Sur PrCar ', true, false),
('Estacionamiento Sur PrMo ', true, true);


INSERT INTO Espacio (tipo, estado, id_Estacionamiento) VALUES 
(false, false, 1),(false, false, 1),(false, false, 1),(false, false, 1),(true, false, 1),
(false, false, 2), (false, false, 2),(true, false, 2),(false, false, 2),(false, false, 2),
(false, false, 3), (false, false, 3),(false, false, 3),(false, false, 3),(true, false, 3),
(false, false, 4),(false, false, 4),(false, false, 4),(false, false, 4), (true, false, 4);

-- Agregar registros a la tabla Usuario TRUE: MOTO, DISCAPACITADO y PROFESOR
INSERT INTO Usuarios (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf, carrera, semestre, Administrador) VALUES 
('S21120218', 'Luis Orlando', SHA2('OrlandoAL1234', 224), false, false, false, 'Ingenieria en sistemas Computacionales', 7, false),
('S21120219', 'Rafael Martinez', SHA2('Rafa12345', 224), true, false, false, 'Ingenieria en sistemas Computacionales', 7, false),
('S21120181', 'Ian Rodolfo', SHA2('1223334444', 224), true, true, false, 'Ingenieria en sistemas Computacionales', 7, false),
('S21120201', 'Angel de Jesus', SHA2('Angel12345', 224), false, false, false, 'Ingenieria en sistemas Computacionales', 8, false);

INSERT INTO Usuarios (usuario, nombre, contrasenia, veiculo, discapacidad, AluProf, carrera, semestre, Administrador) VALUES 
('U00000001', 'Ivan Vega', SHA2('Ivana123456', 224), true, false, true, 'Ingenieria en sistemas Computacionales', 9, false),
('U00000002', 'Fernado Jose', SHA2('Fer123456', 224), false, false, true, 'Ingenieria en sistemas Computacionales', 9, false);




-- Script para busqueda oprima de espacios libres
CREATE INDEX idx_estado ON Espacio (estado);

SELECT * FROM usuarios;
SELECT * FROM Queja;
SELECT * FROM Espacio;
SELECT * FROM estacionamiento;
SELECT * FROM EspUsuario;
