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

drop table turnoMedico;
select*
from turnoMedico;

select *
from nivelVueloUsuario ;

select codigo,nombre from locacion;



-- Trae todos los usuarios con nivel de vuelo asignado
select U.usuario, NV.nivel 
from Usuario as U 
join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario
join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel;


-- trae todos los usuarios con su nivel de vuelo, tengan o no
select U.usuario, NV.nivel 
from Usuario as U 
left join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario
left join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel;


-- Query de Centros medicos con turnos disponibles
select distinct codigo as id, turnos,codigoLocacion as Locacion
from centroMedico as CM 
where CM.turnos > (select distinct count(fechaTurnoMedico) from turnoMedico );


-- Query de Centro medico con turnos disponibles para una fecha determinada
select distinct codigo as id, turnos,codigoLocacion as Locacion
from centroMedico as CM 
where CM.turnos > (select distinct count(fechaTurnoMedico) from turnoMedico where fechaTurnoMedico = "2021.01.01" );


-- Query de Centro medico con turnos disponibles para una fecha determinada
select distinct codigo as id, turnos,codigoLocacion as Locacion
from centroMedico as CM 
where CM.codigo=1 and CM.turnos > (select distinct count(fechaTurnoMedico) from turnoMedico where fechaTurnoMedico = "2021.01.01" );


select distinct L.nombre as Locacion,CM.turnos as Turnos_Totales
from centroMedico as CM join locacion as L on CM.codigoLocacion = L.codigo
where CM.turnos > (select count(fechaTurnoMedico) from turnoMedico);





-- query que trae nombre,origen y destino de un vuelo

select Origen,Destino,t1.Nombre from
(select distinct t.nombre as Nombre,l.nombre as Origen
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
inner join
(select distinct t.nombre as nombre,l.nombre as Destino
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
on t1.nombre=t2.nombre;


select distinct l.nombre as nombre, t.codigoLocacionOrigen as codigo
from trayecto as t 
inner join locacion as l on t.codigoLocacionOrigen = l.codigo;

select distinct l.nombre as codigo, t.codigoLocacionOrigen as nombre
from trayecto as t 
inner join locacion as l on t.codigoLocacionOrigen = l.codigo;




select *
from centroMedico;


select  count(fechaTurnoMedico),fechaTurnoMedico from turnoMedico
group by fechaTurnoMedico;


select*
from turnoMedico;


-- deprecada
select u.email as Email, u.usuario as Nombre, u.nivelVuelo as Nivel_De_Vuelo
from usuario as u 
left join reservaUsuario as ru on u.email=ru.fkemailUsuario
left join reservaPasaje as rp on ru.fkcodigoReserva=rp.codigoReserva
left join vuelo as v on rp.fkCodigoVuelo=codigo
left join equipo as e on v.matriculaEquipo=e.matricula
left join modeloDeEquipo as me on e.fkCodigoModeloEquipo=me.codigo
left join tipoDeEquipo as te on me.fkCodigoTipoEquipo=te.codigo
where u.nivelVuelo=3 and te.nombre like '%Aceleracion%';


select fkEmailId from turnoMedico where fkEmailId = $id ;


insert into nivelVueloUsuario(fkIdUsuario,fkNivelVuelo)values
								(3,3);

create procedure rP_calcularTotal()
as
begin

end



/*
select substring('2021.01.01 17:00:00',11,9);
*/