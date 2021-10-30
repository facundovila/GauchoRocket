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
select distinct codigo as id, turnos,codigoLocacion as Locacion
from centroMedico as CM 
where CM.turnos > (select count(fechaTurnoMedico) from turnoMedico)

select u.email as Email, u.usuario as Nombre, u.nivelVuelo as Nivel_De_Vuelo
from usuario as u 
left join reservaUsuario as ru on u.email=ru.fkemailUsuario
left join reservaPasaje as rp on ru.fkcodigoReserva=rp.codigoReserva
left join viaje as v on rp.fkCodigoViaje=codigo
left join equipo as e on v.matriculaEquipo=e.matricula
left join modeloDeEquipo as me on e.fkCodigoModeloEquipo=me.codigo
left join tipoDeEquipo as te on me.fkCodigoTipoEquipo=te.codigo
where u.nivelVuelo=3 and te.nombre like '%Aceleracion%';

create procedure rP_calcularTotal()
as
begin

end



/*
select substring('2021.01.01 17:00:00',11,9);
*/