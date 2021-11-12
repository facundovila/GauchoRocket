USE dbgr;

drop procedure if exists GR_crearReservasVaciasParaUnVueloAlt;

drop procedure if exists GR_todosLosVuelos;
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
        on t1.nombre=t2.nombre ;
    
end//
DELIMITER ;

drop procedure if exists GR_todosLosVuelosTodosLosParametros;
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

drop procedure if exists GR_capacidadTotalXVuelo;
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

drop procedure if exists GR_capacidadTotalXVueloSoloCantidad;
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

drop procedure if exists GR_capacidadTotalXVueloSoloCantidadOUT;
DELIMITER //
create procedure GR_capacidadTotalXVueloSoloCantidadOUT(in codigoVuelo int,out cantidad int)
begin

	set @Matricula=(select E.matricula 
	from equipo as E
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where V.codigo = codigoVuelo);
    
	select distinct sum(capacidadSuit+capacidadFamiliar+capacidadGeneral)into cantidad
	from modeloDeEquipo as ME
	inner join equipo as E on ME.codigo=E.fkCodigoModeloEquipo
	inner join vuelo as V on V.matriculaEquipo=E.matricula
	where E.matricula = @Matricula;
    
end//
DELIMITER ;


-- procedure para obtener matricula de el equipo que haga X vuelo--------------------------------------------
drop procedure if exists GR_obtenerMatricula;
DELIMITER //
create procedure GR_obtenerMatricula(in codigoVuelo int, out Matricula varchar(15))
begin
		select E.matricula into Matricula
		from equipo as E
		inner join vuelo as V on V.matriculaEquipo=E.matricula
		where V.codigo = codigoVuelo;
end//
DELIMITER ;

drop procedure if exists GR_crearReservasVaciasParaUnVuelo;
DELIMITER //
create procedure GR_crearReservasVaciasParaUnVuelo(in codigoVuelo int)
begin         
		declare i int default 1;
        
			call GR_capacidadTotalXVueloSoloCantidadOUT(codigoVuelo,@cantidad);
			select @cantidad;
        
        while i <= @cantidad
        do

			insert into ubicacion(asiento) values (i);

			set @cU=(select codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1);
						
			insert into reservaPasaje (codigoReserva,fkCodigoUbicacion, fkcodigoVuelo)
							 values (substring(md5(rand()),1,8),@cU ,codigoVuelo); 
								 
			set @cR=(select codigoReserva from reservaPasaje order by fkCodigoUbicacion desc limit 1);

			insert into reservaUsuario(fkcodigoReserva) values (@cR);
			
			set i = i + 1;
        
        end while;

end//
DELIMITER ;

drop procedure if exists GR_crearReservasVaciasParaUnVueloFinal;
DELIMITER //
create procedure GR_crearReservasVaciasParaUnVueloFinal(in codigoVuelo int)
begin         
		declare i int default 1;
        
			delete from ubicacion where fkcodigoReserva in(
			select distinct codigoReserva from reservaPasaje where fkCodigoVuelo = codigoVuelo); 

			delete from reservaUsuario where fkcodigoReserva in(
			select distinct codigoReserva from reservaPasaje where fkCodigoVuelo = codigoVuelo);

			delete from reservaPasaje where fkCodigoVuelo = codigoVuelo;
        
			call GR_capacidadTotalXVueloSoloCantidadOUT(codigoVuelo,@cantidad);
			select @cantidad;
        
        while i < @cantidad+1
        do
			
			insert into ubicacion(asiento) values (i);

			set @cU=(select codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1);
            
			insert into reservaPasaje (codigoReserva,numero,fkcodigoVuelo)
					values (substring(md5(rand()),1,8),@cU,codigoVuelo); 
            
			set @cR=(select codigoReserva from reservaPasaje order by numero desc limit 1);
            
			update ubicacion set fkcodigoReserva = @cR where codigoUbicacion = @cU;
								 
			insert into reservaUsuario(fkcodigoReserva) values (@cR);
			
			set i = i + 1;
        
        end while;

end//
DELIMITER ; 


-- select codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1;

-- CALLS ----------------------------------------------------
-- call GR_obtenerMatricula(1,@Matricula);
-- call GR_todosLosVuelos;
-- call GR_CapacidadTotalXVuelo(4);
-- call GR_todosLosVuelosTodosLosParametros(1,3,NOW(),2);
-- call GR_crearReservasVaciasParaUnVueloFinal (3);

-- call GR_obtenerMatricula(3,@matricula);
-- select @matricula;


-- call GR_capacidadTotalXVueloSoloCantidadOUT(3,@cantidad);
-- select @cantidad as a;

-- ---------------------------------------------------------------

select * from vuelo;
		
select count(codigoReserva)  from reservaPasaje;
select * from reservaPasaje;
select * from reservaUsuario;
select* from ubicacion;


delete from ubicacion where fkcodigoReserva in(
select distinct codigoReserva from reservaPasaje where fkCodigoVuelo = 2); 

delete from reservaUsuario where fkcodigoReserva in(
select distinct codigoReserva from reservaPasaje where fkCodigoVuelo = 2);

delete from reservaPasaje where fkCodigoVuelo = 2;

select codigoReserva from reservaPasaje order by codigoReserva desc limit 1;

