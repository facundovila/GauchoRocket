drop database if exists dbgr;
create database dbgr;
use dbgr;

create table usuario(
email varchar(64) primary key,
dni int,
rol varchar(10),
nombre varchar(50),
apellido varchar(50), 
codigoHash varchar(32)
);

create table admin(
fkEmailUsuario varchar(64) primary key,
id_admin int unique,
foreign key (fkEmailUsuario) references usuario(email)
);

create table cliente(
fkEmailUsuario varchar(64) primary key,
id_cliente int unique,
foreign key (fkEmailUsuario) references usuario(email)
);

create table login(
fkEmailUsuario varchar(64) primary key,
pass varchar(40),
foreign key (fkEmailUsuario) references usuario(email)
);