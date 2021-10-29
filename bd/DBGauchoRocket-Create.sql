drop database if exists dbgr;
create database dbgr;
use dbgr;

create table usuario(
email varchar(70) primary key,
rol varchar(10) DEFAULT "cliente",
usuario varchar(50),
clave varchar(40),
id int unique auto_increment
);

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
codigo int primary key AUTO_INCREMENT,
fkemailusuario varchar(64),
fechaTurnoMedico datetime,
codigoLocacion int,
foreign key (fkemailusuario) references usuario(email),
foreign key (codigoLocacion) references centroMedico(codigoLocacion)
);



