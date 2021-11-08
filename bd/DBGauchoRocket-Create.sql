drop database if exists dbgr;
create database dbgr;
use dbgr;

create table usuario(
email varchar(70) primary key,
rol varchar(10) DEFAULT "cliente",
usuario varchar(50),
clave varchar(40),
nombre varchar(40),
apellido varchar(40),
dni int(30),
telefono int(15),

id int unique auto_increment
);

create table login(
fkemailusuario varchar(70) primary key,
clave varchar(40),
hash varchar(40),
foreign key (fkEmailUsuario) references usuario(email)
);

create table nivelVuelo(
codigo int primary key auto_increment,
nivel int unique,
descripcion varchar (10)
);

create table nivelVueloUsuario(
id int primary key auto_increment,
fkIdUsuario int,
fkNivelVuelo int, 
foreign key (fkIdUsuario) references usuario(id),
foreign key (fkNivelVuelo) references nivelVuelo(nivel)
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
fkIdUsuario int,
fechaTurnoMedico date,
codigoLocacion int,
foreign key (fkIdUsuario) references usuario(id),
foreign key (codigoLocacion) references centroMedico(codigoLocacion)
);

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


create table vuelo(
codigo int primary key auto_increment,
descripcion varchar(100),
precio double(10,2), -- hacer que dependa del equipo que hace el viaje AA mayor costo, BA menor costo igual que orbital
fecha date,
duracion int, -- determina el costo del viaje, mas dias implican mas costos de alojamiento, tambien depende del equipo que haga el viaje
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


create table ubicacion(  -- ubicacion puede tener determinados serivicios y cabina o eso puede pasarse a pasaje, revisar
codigoUbicacion int auto_increment primary key,
ocupada boolean,
filaUbicacion int,
columnaUbicacion int,
fkCodigoCabina int,
foreign key (fkCodigoCabina) references cabina(codigoCabina)
);

create table reservaPasaje(
codigoReserva varchar(8) primary key,
fecha datetime,
totalAPagar double(10,2),
fkCodigoUbicacion int,
fkCodigoVuelo int,
fkCodigoServicio int,
foreign key (fkCodigoVuelo) references vuelo(codigo),
foreign key(fkCodigoServicio) references servicio(codigoServicio),
foreign key (fkCodigoUbicacion) references ubicacion(codigoUbicacion)
);

create table reservaUsuario(
fkcodigoReserva varchar(8),
fkemailUsuario varchar(70),
foreign key (fkcodigoReserva) references reservaPasaje(codigoReserva),
foreign key (fkemailUsuario) references usuario(email)
);

create table pasaje(
id int primary key auto_increment,
fkCodigoReserva varchar(8),
foreign key (fkCodigoReserva) references reservaPasaje(codigoReserva)
);



