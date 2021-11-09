USE dbgr;
drop procedure GR_todosLosVuelos;
drop procedure GR_todosLosVuelosTodosLosParametros;
drop procedure GR_capacidadTotalXVuelo;
drop procedure GR_capacidadTotalXVueloSoloCantidad;
drop procedure GR_obtenerMatricula;


DELIMITER //
create procedure GR_todosLosVuelos()
begin

	SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
        (select distinct v.descripcion as Nombre,l.nombre as Origen,fecha, v.precio as precio
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,v.descripcion as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre;
    
end//
DELIMITER ;

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

-- procedure Total de un equipo determinada segun el codigo del vuelo --------------------------------------------------

DELIMITER //
create procedure GR_capacidadTotalXVuelo(in codigoVuelo int)
begin

	set @Matricula=(select E.matricula 
	from equipo as E
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where V.codigo = codigoVuelo);
    
	select distinct ME.nombre,sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as Capacidad_Total ,E.matricula 
	from modeloDeEquipo as ME
	inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where E.matricula = @Matricula;
    
end//
DELIMITER ;

DELIMITER //
create procedure GR_capacidadTotalXVueloSoloCantidad(in codigoVuelo int)
begin

	set @Matricula=(select E.matricula 
	from equipo as E
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where V.codigo = codigoVuelo);
    
	select distinct sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as capacidad
	from modeloDeEquipo as ME
	inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where E.matricula = @Matricula;
    
end//
DELIMITER ;

-- procedure para obtener matricula de el equipo que haga X vuelo--------------------------------------------
DELIMITER //
create procedure GR_obtenerMatricula(in codigoVuelo int, out Matricula varchar(15))
begin
		select E.matricula 
		from equipo as E
		inner join vuelo as V on V.matriculaEquipo=E.matricula
		where V.codigo = codigoVuelo;
end//
DELIMITER ;

select * from vuelo;
-- call GR_obtenerMatricula(1,@Matricula);
-- call GR_todosLosVuelos;
-- call GR_CapacidadTotalXVuelo(4);
-- call GR_todosLosVuelosTodosLosParametros(1,3,NOW(),2);


set @Matricula=(select E.matricula 
	from equipo as E
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where V.codigo = 4);
SELECT distinct sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as Capacidad_Total
                                from modeloDeEquipo as ME
                                inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
                                inner join vuelo as V on V.matriculaEquipo=E.matricula
                                where E.matricula = @Matricula;
                                
SELECT distinct sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)as Capacidad_Total
                                from modeloDeEquipo as ME
                                inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
                                inner join vuelo as V on V.matriculaEquipo=E.matricula
                                where E.matricula =(select E.matricula from equipo as E
                                              inner join vuelo as V on V.matriculaEquipo=E.matricula where V.codigo = 4); 