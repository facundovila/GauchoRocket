USE dbgr;

-- CALLS ----------------------------------------------------
-- call GR_obtenerMatricula(1,@Matricula);
-- call GR_todosLosVuelos;
-- call GR_CapacidadTotalXVuelo(4);
-- call GR_todosLosVuelosTodosLosParametros(1,3,NOW(),2);
-- call GR_validarNivelUsuario(2,@res);
-- call GR_crearReservasVaciasParaUnVueloFinal (3);
-- call GR_vuelosPorId(2);
-- call GR_tipoDeTrayectoDeUnVuelo(2,@trayecto);
-- call GR_compararNivelUsuarioVuelo(2,1,@res);
-- call GR_ocuparPasajeYUbicacionalt(2,2);

-- call GR_obtenerMatricula(3,@matricula);
-- select @matricula;

-- call GR_capacidadTotalXVueloSoloCantidadOUT(3,@cantidad);
-- select @cantidad as a;

-- call GR_getUsuarioEmailFromId(1,@email);
-- select @email;

-- ---------------------------------------------------------------

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


drop procedure if exists GR_vuelosPorId;
DELIMITER //
create procedure GR_vuelosPorId(in codigoVuelo int)
begin
		SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
                        (select distinct v.descripcion as Nombre,l.nombre as origen, fecha, v.precio as precio,
                        TT.nombre as nombreTrayecto, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where v.codigo = codigoVuelo ) as t1
                        inner join
                        (select distinct t.codigo,v.descripcion as nombre,l.nombre as destino
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
                        on t1.nombre=t2.nombre;
    
end//
DELIMITER ;


drop procedure if exists GR_tipoDeTrayectoDeUnVueloNombre;
DELIMITER //
create procedure GR_tipoDeTrayectoDeUnVueloNombre(in codigoVuelo int,out trayecto varchar(40))
begin
		set trayecto=	(SELECT nombreTrayecto from
                        (select distinct v.descripcion as Nombre,l.nombre as origen, fecha, v.precio as precio,
                        TT.nombre as nombreTrayecto, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where v.codigo = codigoVuelo ) as t1
                        inner join
                        (select distinct t.codigo,v.descripcion as nombre,l.nombre as destino
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
                        on t1.nombre=t2.nombre);
                        
    
end//
DELIMITER ;


drop procedure if exists GR_tipoDeTrayectoDeUnVuelo;
DELIMITER //
create procedure GR_tipoDeTrayectoDeUnVuelo(in codigoVuelo int,out trayecto int)
begin
		set trayecto=	(SELECT case when nombreTrayecto like 'SubOrbitales' then 1
						 when nombreTrayecto like 'EntreDestinos' then 2 when nombreTrayecto like 'Tour' then 3 end from
                        (select distinct v.descripcion as Nombre,l.nombre as origen, fecha, v.precio as precio,
                        TT.nombre as nombreTrayecto, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where v.codigo = codigoVuelo ) as t1
                        inner join
                        (select distinct t.codigo,v.descripcion as nombre,l.nombre as destino
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
                        on t1.nombre=t2.nombre);
                        
end//
DELIMITER ;


drop procedure if exists GR_validarNivelUsuario;  -- Para validar que reservas se pueden hacer o no
DELIMITER //
create procedure GR_validarNivelUsuario(in idUsuario int,out result int)
begin
         
		if exists(SELECT NV.nivel from Usuario as U
				  join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario 
				  join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel WHERE U.id= idUsuario)
		then
		set result=(SELECT NV.nivel from Usuario as U
				    join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario 
				    join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel WHERE U.id= idUsuario);
        
		else 
		set result=0;
		end if;
        
       
end//
DELIMITER ;


drop procedure if exists GR_compararNivelUsuarioVueloAlt;  
DELIMITER //
create procedure GR_compararNivelUsuarioVueloAlt(in idUsuario int,in codigoVuelo int,out resultado boolean) -- Para validar que reservas se pueden hacer o no
begin
         call GR_validarNivelUsuario(idUsuario,@nivel);
         call GR_tipoDeTrayectoDeUnVuelo(codigoVuelo,@trayecto);
         
         if (@nivel>=@trayecto) then 
             set resultado = true;
         elseif (@nivel<@trayecto) then
			 set resultado = false;
         end if;
         
         select resultado;
			
end//
DELIMITER ;


drop procedure if exists GR_compararNivelUsuarioVuelo;  
DELIMITER //
create procedure GR_compararNivelUsuarioVuelo(in idUsuario int,in codigoVuelo int) -- Para validar que reservas se pueden hacer o no
begin
         call GR_validarNivelUsuario(idUsuario,@nivel);
         call GR_tipoDeTrayectoDeUnVuelo(codigoVuelo,@trayecto);
         
         if (@nivel>=@trayecto) then 
             set @resultado = true;
         elseif (@nivel<@trayecto) then
			 set @resultado = null;
         end if;
         
         select @resultado;
			
end//
DELIMITER ;


drop procedure if exists GR_todosLosVuelosTodosLosParametros;
DELIMITER //
create procedure GR_todosLosVuelosTodosLosParametros(in origenO int,in destinoO int,in fechaO date,in tipoO int)
begin

			SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
                        (select distinct v.descripcion as Nombre,l.nombre as origen, fecha, v.precio as precio,
                        TT.nombre as nombreTrayecto, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where t.codigoLocacionOrigen= origenO and TT.codigo = tipoO and fecha = fechaO) as t1
                        inner join
                        (select distinct t.codigo,v.descripcion as nombre,l.nombre as destino
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

drop procedure if exists GR_traerCabinas;
DELIMITER //
create procedure GR_traerCabinas()
begin
		select codigoTipoDeCabina as codigoC,descripcion,precio
		from TipoDeCabina;
end//
DELIMITER ;


drop procedure if exists GR_traerServiciosYCabinas;
DELIMITER //
create procedure GR_traerServiciosYCabinas() -- esto solo funciona asi, esta hardcodeado, sin el where traeria multiples veces los resultados
begin
		select distinct codigoTipoDeServicio as codigoS,TS.descripcion as descripcionS,TS.precio as precioS,
        codigoTipoDeCabina as codigoC,TC.descripcion as descripcionC,TC.precio as precioC
		from TipoDeServicio as TS cross join TipoDeCabina as TC
        where codigoTipoDeServicio=codigoTipoDeCabina;
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


drop procedure if exists GR_listarUbicaciones;
DELIMITER //
create procedure GR_listarUbicaciones(in codigoVuelo int)
begin
    SELECT asiento, ocupado, codigoUbicacion from Ubicacion as U left join reservaPasaje as rP on U.fkcodigoReserva=rP.codigoReserva
                                               left join vuelo as v on rP.fkcodigoVuelo=v.codigo
    where fkcodigoVuelo = codigoVuelo ORDER BY asiento;
end//
DELIMITER ;


drop procedure if exists GR_getUsuarioEmailFromIdConNivel;
DELIMITER //
create procedure GR_getUsuarioEmailFromIdConNivel(in idUsuario int,out email varchar(70))
begin
    if exists(SELECT NV.nivel from Usuario as U
                                       join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario
                                       join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel WHERE U.id= idUsuario)
    then
        set email=(SELECT U.email from Usuario as U
                   WHERE U.id= idUsuario);
    else
        set email='';
    end if;
end//
DELIMITER ;

drop procedure if exists GR_getUsuarioEmail;
DELIMITER //
create procedure GR_getUsuarioEmail(in idUsuario int,out email varchar(70))
begin
        set email=(SELECT U.email from Usuario as U
                   WHERE U.id= idUsuario);
end//
DELIMITER ;


drop procedure if exists GR_ocuparPasajeYUbicacion;
DELIMITER //
create procedure GR_ocuparPasajeYUbicacion(in idUsuario int,in codigoU int)
begin

    call GR_getUsuarioEmail(idUsuario,@emailUsuario);
    set @codigoReserva=(select fkcodigoReserva from ubicacion where codigoUbicacion=codigoU);

    update reservaUsuario as rU set rU.fkemailUsuario = @emailUsuario where rU.fkemailUsuario is null and
            rU.fkcodigoReserva = @codigoReserva;

    update ubicacion set ocupado = true where codigoUbicacion = codigoU and fkCodigoReserva=@codigoReserva;

end//
DELIMITER ;


/*
drop procedure if exists GR_validarPasajeUnicoPorUsuarioVuelo;
DELIMITER //
create procedure GR_validarPasajeUnicoPorUsuarioVuelo()
begin


end//
DELIMITER ;

*/




-- call GR_getUsuarioEmailFromId(2,@emailUsuario);
-- set @emailUsuario=(select email from usuario where id = 2);
-- update reservaUsuario as rU set rU.fkemailUsuario = @emailUsuario where rU.fkemailUsuario is null;


drop procedure if exists GR_getReservasFromUserId;
DELIMITER //
create procedure GR_getReservasFromUserId(in idUsuario int)
begin

    call GR_getUsuarioEmailFromId(idUsuario,@emailUsuario);

    select * from reservaPasaje as rP join reservaUsuario as rU on rP.codigoReserva=rU.fkcodigoReserva
    where rU.fkemailUsuario=@emailUsuario;


end//
DELIMITER ;

select* from ubicacion;

/*

update reservaUsuario set fkEmailUsuario = emailUsuario where  fkEmailUsuario = '';

select codigoReserva from reservaPasaje as rP left join reservaUsuario as rU on rP.codigoResera=rU.fkcodigoReserva
where rU.fkemailUsuario=emailUsuario;

update ubicacion set ocupado = true where codigoUbicacion = codigoUbicacion and fkCodigoReserva=codigoReserva;

SELECT asiento,ocupado from Ubicacion as U left join reservaPasaje as rP on U.fkcodigoReserva=rP.codigoReserva
        left join vuelo as v on rP.fkcodigoVuelo=v.codigo
        where fkcodigoVuelo = 3
        order by asiento;
        
select* from ubicacion;

select codigoTipoDeCabina as codigoC,TC.descripcion as descripcionC,TC.precio as precioC
		from TipoDeCabina as TC
        union 
select codigoTipoDeServicio as codigoS,TS.descripcion as descripcionS,TS.precio as precioS
		from TipoDeServicio as TS;	

select codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1;

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
*/
