USE dbgr;

select rol
from usuario as u join login as l on u.email=l.fkemailusuario;

select*
from usuario;

select rol 
from usuario 
where email = 'cliente' and clave = md5('cliente');

select*
from login;

select *
from locacion;

select*
from centroMedico;

select*
from turnoMedico;

-- Query de Centros medicos con turnos disponibles
select CM.codigo
from centroMedico as CM 
where CM.turnos > (select count(fechaTurnoMedico) from turnoMedico)