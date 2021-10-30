use dbgr;

insert into nivelVuelo(nivel)values
						(1),
                        (2),
                        (3);

insert into usuario(email,rol,usuario,clave)values			
										("admin","admin","admin",md5("admin")),
										("cliente","cliente","cliente",md5("cliente"));
			            
insert into login(fkemailusuario,clave)values
										("admin",md5("admin")),
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
													(1,1),
                                                    (210,13),
                                                    (200,2);

insert into turnoMedico (fkemailusuario, fechaTurnoMedico, codigoLocacion) values
											("admin", '2021.01.01 17:00:00',1),
											("cliente", '2021.01.01 17:00:00',1);

insert into centroMedico (turnos,codigoLocacion) values
													(1,1),
                                                    (210,13),
                                                    (200,2);
                                                    

insert into tipoDeTrayecto (nombre) values
											('Orbitales'),
											('SubOrbitales');

insert into tipoDeEquipo (nombre) values
							('Baja aceleracion'),
							('Alta aceleracion'),
							('Orbitales');


insert into modeloDeEquipo (nombre,fkCodigoTipoEquipo,capacidadSuit,capacidadGeneral,capacidadFamiliar) values
							('Aguila',2, 25, 200, 75),
							('Aguila',2, 25, 200, 75),
							('Aguila',2, 25, 200, 75),
							('Aguila',2, 25, 200, 75),
							('Aguila',2, 25, 200, 75),
							('Aguilucho',1, 10, 0, 50),
							('Aguilucho',1, 10, 0, 50),
							('Aguilucho',1, 10, 0, 50),
							('Aguilucho',1, 10, 0, 50),
							('Aguilucho',1, 10, 0, 50),
							('Calandria',3, 25, 200, 75),
							('Calandria',3, 25, 200, 75),
							('Calandria',3, 25, 200, 75),
							('Calandria',3, 25, 200, 75),
							('Canario',1, 10, 0, 70),
							('Canario',1, 10, 0, 70),
							('Canario',1, 10, 0, 70),
							('Canario',1, 10, 0, 70),
							('Canario',1, 10, 0, 70),
							('Carancho',1, 0, 110, 0),
							('Carancho',1, 0, 110, 0),
							('Carancho',1, 0, 110, 0),
							('Carancho',1,0, 110, 0),
							('Colibri',3, 2, 100, 18),
							('Colibri',3, 2, 100, 18),
							('Colibri',3, 2, 100, 18),
							('Colibri',3, 2, 100, 18),
							('Colibri',3, 2, 100, 18),
							('Condor',2, 40, 300, 10),
							('Condor',2, 40, 300, 10),
							('Condor',2, 40, 300, 10),
							('Condor',2, 40, 300, 10),
							('Condor',2, 40, 300, 10),
							('Guanaco',2, 100, 0, 0),
							('Guanaco',2, 100, 0, 0),
							('Guanaco',2, 100, 0, 0),
							('Guanaco',2, 100, 0, 0),
							('Halcon',2, 25, 150, 25),
							('Halcon',2, 25, 150, 25),
							('Halcon',2, 25, 150, 25),
							('Halcon',2, 25, 150, 25),
							('Halcon',2, 25, 150, 25),
							('Zorzal',1, 0, 50, 50),
							('Zorzal',1, 0, 50, 50),
							('Zorzal',1, 0, 50, 50); 



insert into Equipo (matricula,fkCodigoModeloEquipo) values
					('AA1',1),
					('AA5',2),
					('AA9',3),
					('AA13',4),
					('AA17',5),
					('BA8',6),
					('BA9',7),
					('BA10',8),
					('BA11',9),
					('BA12',10),
					('O1',11),
					('O2',12),
					('O6',13),
					('O7',14),
					('BA13',15),
					('BA14',16),
					('BA15',17),
					('BA16',18),
					('BA17',19),
					('BA4',20),
					('BA5',21),
					('BA6',22),
					('BA7',23),
					('O3',24),
					('O4',25),
					('O5',26),
					('O8',27),
					('O9',28),
					('AA2',29),
					('AA6',30),
					('AA10',31),
					('AA14',32),
					('AA18',33),
					('AA4',34),
					('AA8',35),
					('AA12',36),
					('AA16',37),
					('AA3',38),
					('AA7',39),
					('AA11',40),
					('AA15',41),
					('AA19',42),
					('BA1',43),
					('BA2',44),
					('BA3',45); 
					 
            
 insert into Trayecto (codigoLocacionOrigen,codigoLocacionDestino,codigoTipoDeTrayecto,precio,nombre) values
					 (1,3,2,20000,'Buenos Aires - EEI'),
					 (2,13,1,6000,'Ankara - Shanghai'),
                     (13,6,2,35000,'Shanghai - Marte');
                     
insert into viaje(descripcion,precio,fecha,duracion,matriculaEquipo,codigoTrayecto) values
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
 
 insert into ubicacion(ocupada,fkCodigoViaje,fkCodigoCabina,fkCodigoServicio,nroUbicacion) values
						(false,1,1,1,20),
                        (false,2,3,3,2);
                        

 