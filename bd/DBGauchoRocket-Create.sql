drop database if exists dbgr;
create database dbgr;
use dbgr;

create table nivelVuelo(
codigo int primary key auto_increment,
nivel int unique
);

create table usuario(
email varchar(70) primary key,
rol varchar(10) DEFAULT "cliente",
usuario varchar(50),
nivelVuelo int default null,
clave varchar(40),
id int unique auto_increment,
foreign key (nivelVuelo) references nivelVuelo(nivel)
);

/*
create table admin(
fkemailusuario varchar(70) primary key,
id_admin int unique auto_increment,
foreign key (fkEmailUsuario) references usuario(email)
);
create table cliente(
fkemailusuario varchar(70) primary key,
id_cliente int unique auto_increment,
foreign key (fkEmailUsuario) references usuario(email)
);
*/

create table login(
fkemailusuario varchar(70) primary key,
clave varchar(40),
hash varchar(40),
foreign key (fkEmailUsuario) references usuario(email)
);

create table locacion(
codigo int primary key auto_increment,
nombre varchar(50)
);

create table centroMedico(
codigo int primary key auto_increment,
turnos int,
codigoLocacion int,
foreign key (codigoLocacion) references locacion(codigo)
);

create table turnoMedico(
codigo int primary key auto_increment,
fkemailusuario varchar(64),
fechaTurnoMedico datetime,
codigoLocacion int,
foreign key (fkemailusuario) references usuario(email),
foreign key (codigoLocacion) references centroMedico(codigoLocacion)
);
/*  ----------    */
create table tipoDeTrayecto(
codigo int primary key auto_increment,
nombre varchar(40)
);

create table trayecto(
codigo int primary key auto_increment,
codigoLocacionOrigen int,
codigoLocacionDestino int,
codigoTipoDeTrayecto int,
precio double (10,2),
nombre varchar(50),
duracion int, -- determina el costo del viaje, mas dias implican mas costos de alojamiento
foreign key (codigoLocacionOrigen) references locacion(codigo),
foreign key (codigoLocacionDestino) references locacion(codigo),
foreign key (codigoTipoDeTrayecto) references tipoDeTrayecto(codigo)
);

create table tipoDeEquipo(
codigo int primary key auto_increment,
nombre varchar(40)  -- Comparar con el niveldevuelo del usuario para determinar si puede o no tomar ese vuelo, 1 y 2 = Orbitales y BA, 3 = Todos
);

create table modeloDeEquipo(
codigo int primary key auto_increment,
nombre varchar(50),
fkCodigoTipoEquipo int,
capacidadSuit int,
capacidadGeneral int,
capacidadFamiliar int,
foreign key (fkCodigoTipoEquipo) references tipoDeEquipo(codigo)
);

create table equipo(
matricula varchar(15) primary key,
fkCodigoModeloEquipo int,
foreign key (fkCodigoModeloEquipo) references modeloDeEquipo(codigo)
);


create table viaje(
codigo int primary key auto_increment,
descripcion varchar(100),
precio double(10,2),
fecha datetime,
matriculaEquipo varchar(15),
codigoTrayecto int,
foreign key (codigoTrayecto) references Trayecto(codigo),
foreign key (matriculaEquipo) references equipo(matricula)
);

create table tipoDeCabina(
codigoTipoDeCabina int primary key auto_increment,
descripcion varchar(50),
precio double(10,2)
);

create table cabina(
codigoCabina int primary key auto_increment,
fkCodigoTipoDeCabina int,
foreign key (fkCodigoTipoDeCabina) references tipoDeCabina(codigoTipoDeCabina)
);

create table tipoDeServicio(
codigoTipoDeServicio int primary key auto_increment,
precio double (10,2),
descripcion varchar(50)
);

create table servicio(
codigoServicio int primary key auto_increment,
fkcodigoTipoDeServicio int,
foreign key (fkcodigoTipoDeServicio) references tipoDeServicio(codigoTipoDeServicio)
);


create table ubicacion(
codigoUbicacion int auto_increment primary key,
ocupada boolean,
fkCodigoViaje int,
fkCodigoCabina int,
nroUbicacion varchar (2),
foreign key (fkCodigoViaje) references viaje(codigo),
foreign key (fkCodigoCabina) references cabina(codigoCabina)
);

create table reservaPasaje(
codigoDeReserva varchar(8) primary key,
fecha datetime,
pago boolean
);

create table pasaje(
id int primary key auto_increment,
fkCodigoDeReserva varchar(8),
checkin boolean,
foreign key (fkCodigoDeReserva) references reservaPasaje(codigoDeReserva)
);



