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
											("admin", '2019.01.01 17:00:00',1),
											("cliente", '2019.01.01 17:00:00',1);

insert into centroMedico (turnos,codigoLocacion) values
													(1,1),
                                                    (210,13),
                                                    (200,2);


 




 
            



