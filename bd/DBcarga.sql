use dbgr;

insert into nivelVuelo(nivel,descripcion)values
						(1,"Nivel Uno"),
                        (2,"Nivel Dos"),
                        (3,"Nivel Tres");

insert into usuario(email,rol,usuario,clave)values			
										("admin","admin","admin",md5("admin")),
										("cliente","cliente","cliente",md5("cliente"));
	

insert into usuario(email,rol,usuario,clave)values	
													("vuelo","cliente","vuelo",md5("vuelo"));
                                                    
insert into nivelVueloUsuario(fkIdUsuario,fkNivelVuelo)values
								(3,3);
    
insert into login(fkemailusuario,clave)values
										("admin",md5("admin")),
                                        ("vuelo",md5("vuelo")),
										("cliente",md5("cliente"));
                                        
insert into locacion (nombre) values
								('Buenos Aires'),
								('Ankara'),
								('EEI'),
								('Orbiter Hotel'),
								('Luna'),
								('Marte'),
								('Europa'),
								('Io'),
								('Encelado'),
								('Titan'),
								('Ganimedes'),
								('Neptuno'),
								('Shanghai');
                                
insert into centroMedico (turnos,codigoLocacion) values
													(300,1),
                                                    (210,13),
                                                    (200,2);

/*
insert into turnoMedico (fkIdUsuario, fechaTurnoMedico, codigoLocacion) values
											(1, '2021.01.01',1),
											(2, '2021.01.01',1);

insert into turnoMedico (fkIdUsuario, fechaTurnoMedico, codigoLocacion) values
								(3, '2021.01.01',1);
 */                         
                                
insert into tipoDeTrayecto (nombre) values
											('Orbitales'),
											('SubOrbitales');

insert into tipoDeEquipo (nombre) values
							('Orbitales'),
							('Baja Aceleracion'),
							('Alta Aceleracion');


insert into modeloDeEquipo (nombre,fkCodigoTipoEquipo,capacidadSuit,capacidadGeneral,capacidadFamiliar) values
							('Aguila',2, 25, 200, 75),
							('Aguilucho',1, 10, 0, 50),
							('Calandria',3, 25, 200, 75),
							('Canario',1, 10, 0, 70),
							('Carancho',1, 0, 110, 0),
							('Colibri',3, 2, 100, 18),
							('Condor',2, 40, 300, 10),
							('Guanaco',2, 100, 0, 0),
							('Halcon',2, 25, 150, 25),
							('Zorzal',1, 0, 50, 50); 



insert into Equipo (matricula,fkCodigoModeloEquipo) values
					('AA1',1),
					('AA5',1),
					('AA9',1),
					('AA13',1),
					('AA17',1),
					('BA8',2),
					('BA9',2),
					('BA10',2),
					('BA11',2),
					('BA12',2),
					('O1',3),
					('O2',3),
					('O6',3),
					('O7',3),
					('BA13',4),
					('BA14',4),
					('BA15',4),
					('BA16',4),
					('BA17',4),
					('BA4',5),
					('BA5',5),
					('BA6',5),
					('BA7',5),
					('O3',6),
					('O4',6),
					('O5',6),
					('O8',6),
					('O9',6),
					('AA2',7),
					('AA6',7),
					('AA10',7),
					('AA14',7),
					('AA18',7),
					('AA4',8),
					('AA8',8),
					('AA12',8),
					('AA16',8),
					('AA3',9),
					('AA7',9),
					('AA11',9),
					('AA15',9),
					('AA19',9),
					('BA1',10),
					('BA2',10),
					('BA3',10); 
					 
            
 insert into Trayecto (codigoLocacionOrigen,codigoLocacionDestino,codigoTipoDeTrayecto,precio,nombre) values
					 (1,3,2,20000,'Buenos Aires - EEI'),
					 (2,13,1,6000,'Ankara - Shanghai'),
                     (13,6,2,35000,'Shanghai - Marte');
                     
insert into vuelo(descripcion,precio,fecha,duracion,matriculaEquipo,codigoTrayecto) values
				 ('Viaje De Alta Aceleracion desde Buenos Aires hasta la Estacion Espacial Internacional',23000,now(),3,'AA1',1),
                 ('Viaje Orbital desde Anakara hasta Shanghai',6000,now(),8,'O5',2);

insert into tipoDeCabina (descripcion, precio) values
									('General', 350),
									('Familiar', 550),
									('Suite', 850);
                                    
 insert into cabina (fkcodigoTipoDeCabina) values
										(1),
										(2),
										(3);
                                        
insert into tipoDeServicio (descripcion, precio) values
							('Standard', 1000),
							('Gourmet', 2000),
							('Spa', 4000);
                            
 insert into servicio (fkcodigoTipoDeServicio) values
										(1),
										(2),
										(3);
 
 insert into ubicacion(ocupada,nroUbicacion) values
						(false,20),
                        (false,2);
                        
insert into reservaPasaje(codigoReserva,fecha,pago,checkin,fkCodigoVuelo) values
								('codigoRe',now(),false,false,1);
               
insert into reservaUsuario(fkemailUsuario,fkcodigoReserva) values 
							('vuelo','codigoRe');