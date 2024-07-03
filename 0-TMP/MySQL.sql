DROP database salon;
CREATE DATABASE salon;
USE salon;

CREATE TABLE Salones(
ID_salon int PRIMARY KEY AUTO_INCREMENT,
nombre varchar(255),
capacidad_min int,
capacidad_max int,
ubicacion varchar(255)
);

CREATE TABLE Servicios(
ID_servicio int PRIMARY KEY AUTO_INCREMENT,
tipo_servicio varchar(255) check (tipo_servicio in ('musica','comida','meseros','barra','parking','maestro de ceremonia','dulceria','decoracion','coctel bienvenida')),
costo decimal(10,2)
);

create table Cliente(
ID_cliente int PRIMARY KEY AUTO_INCREMENT,
nombre varchar(255),
apellido_p varchar(255),
apellido_m varchar(255),
telefono varchar(10)
);

CREATE TABLE Tipo_eventos(
ID_tipoE int PRIMARY KEY AUTO_INCREMENT,
nombre varchar(255) check (nombre in ('xv años','boda','graduacion','primera comunion','bautizo'))
);

create table Entradas(
ID_OEntrada int PRIMARY KEY AUTO_INCREMENT,
entrada varchar(255) check (entrada in('crema elote', 'crema poblana', 'crema de champiñones', 'propio'))
);

create table Medios(
ID_OMedio int PRIMARY KEY AUTO_INCREMENT,
platoMedio varchar(255) check (platoMedio in('spaguetti excelencia', 'spaguetti cremoso', 'macarrones con queso', 'propio'))
);

create table Fuertes(
ID_OFuerte int PRIMARY KEY AUTO_INCREMENT,
platoFuerte varchar(255) check (platoFuerte in('chuleta adobada', 'pechuga rellena con chipotle', 'pierna enchilada', 'propio'))
);

create table Comida(
ID_menu int PRIMARY KEY AUTO_INCREMENT,
ID_OEntrada int,
ID_OMedio int,
ID_OFuerte int,
cantidad int,
foreign key  (ID_OEntrada) references Entradas(ID_OEntrada) on delete cascade on update cascade,
foreign key  (ID_OMedio) references Medios(ID_OMedio) on delete cascade on update cascade,
foreign key  (ID_OFuerte) references Fuertes(ID_OFuerte) on delete cascade on update cascade
);

create table Eventos(
ID_evento int PRIMARY KEY AUTO_INCREMENT,
fecha date,
hora_ini time,
hora_fin time,
personas int,
tipo_evento int,
ID_menu int,
foreign key  (tipo_evento) references Tipo_eventos(ID_tipoE) on delete cascade on update cascade,
foreign key  (ID_menu) references Comida(ID_menu) on delete cascade on update cascade
);

create table Servicios_salon(
ID_salon int,
ID_servicio int,
foreign key  (ID_salon) references Salones(ID_salon) on delete cascade on update cascade,
foreign key  (ID_servicio) references Servicios(ID_servicio) on delete cascade on update cascade
);

create table Eventos_salones(
ID_salon int,
ID_evento int,
foreign key  (ID_salon) references Salones(ID_salon) on delete cascade on update cascade,
foreign key  (ID_evento) references Eventos(ID_evento) on delete cascade on update cascade
);

create table Contratos(
ID_contrato int PRIMARY KEY AUTO_INCREMENT,
ID_cliente int,
ID_evento int,
foreign key  (ID_cliente) references Cliente(ID_cliente) on delete cascade on update cascade,
foreign key  (ID_evento) references Eventos(ID_evento) on delete cascade on update cascade
);x

/*insertamos los salones*/
insert into Salones (nombre, capacidad_min, capacidad_max, ubicacion)values('Salon La Condesa', 100, 300, 'La Condesa');
insert into Salones (nombre, capacidad_min, capacidad_max, ubicacion) values('Salon Claveria', 100, 500, 'Claveria');
insert into Salones (nombre, capacidad_min, capacidad_max, ubicacion) values('Salon Azcapotzalco', 100, 350, 'Azcapotzalco');
insert into Salones (nombre, capacidad_min, capacidad_max, ubicacion) values('Salon El Rosario', 100, 250, 'El Rosario');
insert into Salones (nombre, capacidad_min, capacidad_max, ubicacion) values('Salon Tacubaya', 100, 300, 'Tacubaya');
/*insertamos clientes*/
insert into Cliente (nombre, apellido_p, apellido_m, telefono) values('Mario', 'Ortiz', 'Lopez','5512859375');
insert into Cliente (nombre, apellido_p, apellido_m, telefono) values ('María', 'González', 'Pérez', '5512345678');
insert into Cliente (nombre, apellido_p, apellido_m, telefono) values ('Juan', 'Hernández', 'Ramírez', '5598765432');
insert into Cliente (nombre, apellido_p, apellido_m, telefono) values ('Ana', 'Martínez', 'López', '5534567890');
insert into Cliente (nombre, apellido_p, apellido_m, telefono) values ('Carlos', 'Sánchez', 'Torres', '5543216789');
/*agregamos los posibles servicios*/
insert into Servicios (tipo_servicio, costo) values('musica',2000);
insert into Servicios (tipo_servicio, costo) values('maestro de ceremonia',500);
insert into Servicios (tipo_servicio, costo) values('dulceria',300);
insert into Servicios (tipo_servicio, costo) values('decoracion',1500);
insert into Servicios (tipo_servicio, costo) values('coctel bienvenida',500);
insert into Servicios (tipo_servicio, costo) values('comida',200);
insert into Servicios (tipo_servicio, costo) values('meseros',400);
insert into Servicios (tipo_servicio, costo) values('barra',400);
insert into Servicios (tipo_servicio, costo) values('parking',200);
/*agregamos los tipos de eventos*/
insert into Tipo_eventos (nombre) values('xv años');
insert into Tipo_eventos (nombre) values('boda');
insert into Tipo_eventos (nombre) values('graduacion');
insert into Tipo_eventos (nombre) values('primera comunion');
insert into Tipo_eventos (nombre) values('bautizo');
/*Entradas del menu*/
insert into Entradas (entrada) values('crema elote');
insert into Entradas (entrada) values('crema poblana');
insert into Entradas (entrada) values('crema de champiñones');
insert into Entradas (entrada) values('propio');
/*platos medios del menu*/
insert into Medios (platoMedio) values('spaguetti excelencia');
insert into Medios (platoMedio) values('spaguetti cremoso');
insert into Medios (platoMedio) values('macarrones con queso');
insert into Medios (platoMedio) values('propio');
/*platos fuertes del menu*/
insert into Fuertes (platoFuerte) values('chuleta adobada');
insert into Fuertes (platoFuerte) values('pechuga rellena con chipotle');
insert into Fuertes (platoFuerte) values('pierna enchilada');
insert into Fuertes (platoFuerte) values('propio');
/*asignamos el menu con sus respectivas opciones de platos*/
insert into Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) values(1,1,1,100);
insert into Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) values(2,2,2,150);
insert into Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) values(3,3,3,120);
insert into Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) values(4,1,1,200);
insert into Comida (ID_OEntrada, ID_OMedio, ID_OFuerte, cantidad) values(1,4,2,250);
/*agregamos unos eventos*/
insert into Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) values ('2024-06-15', '18:00', '23:00', 200, (select ID_tipoE from Tipo_eventos where nombre = 'xv años'), (select ID_menu from Comida where ID_menu = 1));
insert into Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) values ('2024-07-20', '12:00', '18:00', 150, (select ID_tipoE from Tipo_eventos where nombre = 'boda'), (select ID_menu from Comida where ID_menu = 2));
insert into Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) values ('2024-09-05', '10:00', '16:00', 300, (select ID_tipoE from Tipo_eventos where nombre = 'graduacion'), (select ID_menu from Comida where ID_menu = 3));
insert into Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) values ('2024-05-30', '14:00', '19:00', 100, (select ID_tipoE from Tipo_eventos where nombre = 'primera comunion'),(select ID_menu from Comida where ID_menu = 4));
insert into Eventos (fecha, hora_ini, hora_fin, personas, tipo_evento, ID_menu) values ('2024-08-25', '09:00', '14:00', 180, (select ID_tipoE from Tipo_eventos where nombre = 'bautizo'), (select ID_menu from Comida where ID_menu = 5));
/*asociamos los servicios que tienen cada salon*/
insert into Servicios_salon (ID_salon, ID_servicio) values(1,1);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,2);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,3);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,4);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,5);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,6);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,7);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,8);
insert into Servicios_salon (ID_salon, ID_servicio) values(1,9);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,1);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,2);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,3);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,4);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,5);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,6);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,7);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,8);
insert into Servicios_salon (ID_salon, ID_servicio) values(2,9);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,1);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,2);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,3);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,4);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,5);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,6);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,7);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,8);
insert into Servicios_salon (ID_salon, ID_servicio) values(3,9);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,1);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,2);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,3);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,4);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,5);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,6);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,7);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,8);
insert into Servicios_salon (ID_salon, ID_servicio) values(4,9);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,1);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,2);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,3);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,4);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,5);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,6);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,7);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,8);
insert into Servicios_salon (ID_salon, ID_servicio) values(5,9);
/*asociamos los eventos que hay en cada salon*/
insert into Eventos_salones (ID_salon, ID_evento) values ((select ID_salon from Salones where nombre = 'Salon La Condesa'), (select ID_evento from Eventos where fecha = '2024-06-15' and hora_ini = '18:00'));
insert into Eventos_salones (ID_salon, ID_evento) values ((select ID_salon from Salones where nombre = 'Salon Claveria'), (select ID_evento from Eventos where fecha = '2024-07-20' and hora_ini = '12:00'));
insert into Eventos_salones (ID_salon, ID_evento) values ((select ID_salon from Salones where nombre = 'Salon Azcapotzalco'), (select ID_evento from Eventos where fecha = '2024-09-05' and hora_ini = '10:00'));
insert into Eventos_salones (ID_salon, ID_evento) values ((select ID_salon from Salones where nombre = 'Salon El Rosario'), (select ID_evento from Eventos where fecha = '2024-05-30' and hora_ini = '14:00'));
insert into Eventos_salones (ID_salon, ID_evento) values ((select ID_salon from Salones where nombre = 'Salon Tacubaya'), (select ID_evento from Eventos where fecha = '2024-08-25' and hora_ini = '09:00'));
/*generamos los contratos de acuerdo al cliente y evento*/
insert into Contratos (ID_cliente, ID_evento) values ((select ID_cliente from Cliente where nombre = 'Mario' and apellido_p = 'Ortiz' and apellido_m = 'Lopez'), (select ID_evento from Eventos where fecha = '2024-06-15' and hora_ini = '18:00'));
insert into Contratos (ID_cliente, ID_evento) values ((select ID_cliente from Cliente where nombre = 'Juan' and apellido_p = 'Hernández' and apellido_m = 'Ramírez'), (select ID_evento from Eventos where fecha = '2024-07-20' and hora_ini = '12:00'));
insert into Contratos (ID_cliente, ID_evento) values ((select ID_cliente from Cliente where nombre = 'Ana' and apellido_p = 'Martínez' and apellido_m = 'López'), (select ID_evento from Eventos where fecha = '2024-09-05' and hora_ini = '10:00'));
insert into Contratos (ID_cliente, ID_evento) values ((select ID_cliente from Cliente where nombre = 'Carlos' and apellido_p = 'Sánchez' and apellido_m = 'Torres'), (select ID_evento from Eventos where fecha = '2024-05-30' and hora_ini = '14:00'));
insert into Contratos (ID_cliente, ID_evento) values ((select ID_cliente from Cliente where nombre = 'Laura' and apellido_p = 'García' and apellido_m = 'Núñez'), (select ID_evento from Eventos where fecha = '2024-08-25' and hora_ini = '09:00'));

/*creamos la vista de Clientes y sus Eventos*/
create view ClientesEventos as
select 
    c.ID_cliente,
    c.nombre as NombreCliente,
    c.apellido_p as ApellidoPaterno,
    c.apellido_m as ApellidoMaterno,
    c.telefono,
    e.ID_evento,
    e.fecha,
    e.hora_ini,
    e.hora_fin,
    te.nombre as TipoEvento
from 
    Cliente c
    inner join Contratos ct on c.ID_cliente = ct.ID_cliente
    inner join Eventos e on ct.ID_evento = e.ID_evento
    inner join Tipo_eventos te on e.tipo_evento = te.ID_tipoE;
    
    /*Vista de salones y servicios disponibles*/
    create view SalonesServicios as
select 
    s.ID_salon,
    s.nombre as NombreSalon,
    s.capacidad_min,
    s.capacidad_max,
    s.ubicacion,
    srv.tipo_servicio,
    srv.costo
from 
    Salones s
    inner join Servicios_salon ss on s.ID_salon = ss.ID_salon
    inner join Servicios srv on ss.ID_servicio = srv.ID_servicio;
    
    /*Vista de menus completos*/
    create view MenusCompletos as
select 
    cm.ID_menu,
    en.entrada as Entrada,
    me.platoMedio as PlatoMedio,
    fu.platoFuerte as PlatoFuerte,
    cm.cantidad
from 
    Comida cm
    inner join Entradas en on cm.ID_OEntrada = en.ID_OEntrada
    inner join Medios me on cm.ID_OMedio = me.ID_OMedio
    inner join Fuertes fu on cm.ID_OFuerte = fu.ID_OFuerte;
    /*Vista de Eventos por Salon*/
    create view EventosPorSalon as
select 
    s.ID_salon,
    s.nombre as NombreSalon,
    e.ID_evento,
    e.fecha,
    e.hora_ini,
    e.hora_fin,
    e.personas,
    te.nombre as TipoEvento
from 
    Salones s
    inner join Eventos_salones es on s.ID_salon = es.ID_salon
    inner join Eventos e on es.ID_evento = e.ID_evento
    inner join Tipo_eventos te on e.tipo_evento = te.ID_tipoE;
    /*Vista de Eventos con Menus detallados*/
    create view EventosConMenus as
select 
    e.ID_evento,
    e.fecha,
    e.hora_ini,
    e.hora_fin,
    e.personas,
    te.nombre as TipoEvento,
    en.entrada as Entrada,
    me.platoMedio as PlatoMedio,
    fu.platoFuerte as PlatoFuerte,
    cm.cantidad
from 
    Eventos e
    inner join Tipo_eventos te on e.tipo_evento = te.ID_tipoE
    inner join Comida cm on e.ID_menu = cm.ID_menu
    inner join Entradas en on cm.ID_OEntrada = en.ID_OEntrada
    inner join Medios me on cm.ID_OMedio = me.ID_OMedio
    inner join Fuertes fu on cm.ID_OFuerte = fu.ID_OFuerte;
    /*Vista resumen de eventos por tipo*/
    CREATE VIEW vw_ResumenEventosTipo AS
SELECT te.nombre AS tipo_evento, COUNT(e.ID_evento) AS cantidad_eventos
FROM Eventos e
JOIN Tipo_eventos te ON e.tipo_evento = te.ID_tipoE
GROUP BY te.nombre;
    /*consultas normales de las tablas*/
    select * from Eventos_salones;
select * from Salones;
select * from Servicios;
select * from Cliente;
select * from Contratos;
select * from Eventos;
select * from Servicios_salon;
select * from Tipo_eventos;
select * from Fuertes;
select * from Medios;
select * from Entradas;
select * from Comida;
    /*uso de las vistas*/
    select * from ClientesEventos;
select * from SalonesServicios;
select * from EventosConMenus;
select * from EventosPorSalon;
select * from MenusCompletos;
select * from vw_ResumenEventosTipo;
    