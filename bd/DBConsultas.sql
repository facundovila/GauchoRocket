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





-- query que trae nombre,origen y destino de todos los vuelos done

SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
        (select distinct t.nombre as Nombre,l.nombre as Origen,fecha, v.precio as precio
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,t.nombre as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre;


-- Altsers done
select codigo,origen,destino,t1.Nombre as nombre,fecha,precio,nombreTrayecto from
(select distinct t.nombre as Nombre,l.nombre as Origen,fecha, v.precio as precio,TT.nombre as nombreTrayecto
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionOrigen=l.codigo
inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
where t.codigoLocacionOrigen= 1 and fecha= '2021-11-08' and TT.codigo=2) as t1
inner join
(select distinct t.codigo,t.nombre as nombre,l.nombre as Destino
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionDestino=l.codigo
where t.codigoLocacionDestino= 3 ) as t2
on t1.nombre=t2.nombre;

select codigo,Origen,Destino,t1.Nombre from
(select distinct t.nombre as Nombre,l.nombre as Origen
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionOrigen=l.codigo
inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
where t.codigoLocacionOrigen= 1 and fecha= now() and TT.nombre = 'SubOrbitales') as t1
inner join
(select distinct t.codigo,t.nombre as nombre,l.nombre as Destino
from vuelo as v
inner join trayecto as t on v.codigoTrayecto=t.codigo
inner join locacion as l on t.codigoLocacionDestino=l.codigo
where t.codigoLocacionDestino= 3 ) as t2
on t1.nombre=t2.nombre;

-- query para sumar los precios de todo (not done)

select distinct sum(V.precio+TS.precio+TC.precio) from vuelo as V join  on V.codigoTrayecto;

-- calcular capacidad total de equipo
select ME.nombre,sum(capacidadSuit+capacidadFamiliar+capacidadGeneral) as Capacidad
from modeloDeEquipo as ME
group by ME.nombre;

-- Capacidad total de un equipo segun su matricula
select distinct ME.nombre,sum(capacidadSuit+capacidadFamiliar+capacidadGeneral) as Capacidad_Total
from modeloDeEquipo as ME
inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
inner join vuelo as V on V.matriculaEquipo=E.matricula
where E.matricula ='O5';

select E.matricula 
from equipo as E
inner join vuelo as V on V.matriculaEquipo=E.matricula
where V.codigo = 1;


-- Capacidad Total de un equipo determinada segun el codigo del vuelo 
set @Matricula=(select E.matricula 
from equipo as E
inner join vuelo as V on V.matriculaEquipo=E.matricula
where V.codigo = 1);
select distinct ME.nombre,sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as Capacidad_Total ,E.matricula 
from modeloDeEquipo as ME
inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
inner join vuelo as V on V.matriculaEquipo=E.matricula
where E.matricula = @Matricula;

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
   
-- procedure Total de un equipo determinada segun el codigo del vuelo 
DELIMITER //
create procedure GR_CapacidadTotalXVuelo(in codigoVuelo int)
begin

	set @Matricula=(select E.matricula 
	from equipo as E
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where V.codigo = 1);
    
	select distinct ME.nombre,sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as Capacidad_Total ,E.matricula 
	from modeloDeEquipo as ME
	inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where E.matricula = @Matricula;
    
end//
DELIMITER ;

-- procedure para obtener matricula de el equipo que haga X vuelo
DELIMITER //
create procedure GR_obtenerMatricula(in codigoVuelo int, out Matricula varchar(15))
begin
		select E.matricula 
		from equipo as E
		inner join vuelo as V on V.matriculaEquipo=E.matricula
		where V.codigo = codigoVuelo;
end//
DELIMITER ;


DELIMITER //
create procedure GR_todosLosVuelos()
begin

	SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
        (select distinct t.nombre as Nombre,l.nombre as Origen,fecha, v.precio as precio
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,t.nombre as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre;
    
end//
DELIMITER ;

drop procedure GR_todosLosVuelosTodosLosParametros;
DELIMITER //
create procedure GR_todosLosVuelosTodosLosParametros(in origenO int,in destinoO int,in fechaO date,in tipoO int)
begin

		SELECT codigo,origen,destino,t1.Nombre as nombre, fecha, precio, vueloId,nombreTrayecto from
                        (select distinct t.nombre as Nombre,l.nombre as origen, fecha, v.precio as precio,
                        TT.nombre as nombreTrayecto, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where t.codigoLocacionOrigen= origenO and TT.codigo = tipoO and fecha = fechaO) as t1
                        inner join
                        (select distinct t.codigo,t.nombre as nombre,l.nombre as destino
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionDestino=l.codigo
                        where t.codigoLocacionDestino= destinoO ) as t2
                        on t1.nombre=t2.nombre;
    
end//
DELIMITER ;

-- call GR_obtenerMatricula(1,@Matricula);
 call GR_todosLosVuelos;
-- call GR_CapacidadTotalXVuelo(1);
 call GR_todosLosVuelosTodosLosParametros(1,3,NOW(),2);

select substring('2021.01.01 17:00:00',11,9);
