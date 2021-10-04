use dbgr;

insert into usuario(email,rol,usuario)
             values("admindoko@nomail.com","Admin","Kero");
             
	
insert into admin(fkemailusuario,id_admin)
            values("admindoko@nomail.com",1);
            
select*
from usuario;

select *
from cliente;