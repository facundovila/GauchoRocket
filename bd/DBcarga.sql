use dbgr;

insert into usuario(email,rol,usuario,clave)
             values("admin","admin","admin",md5("admin"));
			            
insert into login(fkemailusuario,clave)
            values("admin",md5("admin"));


            
select*
from usuario;

select*
from login;



