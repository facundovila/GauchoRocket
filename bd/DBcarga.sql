use dbgr;

insert into usuario(email,rol,usuario,clave)
             values("admin","admin","admin",md5("admin"));
			            
insert into login(fkemailusuario,clave)
            values("admin",md5("admin"));
            
insert into usuario(email,usuario,clave)
             values("cliente","cliente",md5("cliente"));
			            
insert into login(fkemailusuario,clave)
            values("cliente",md5("cliente"));

select rol
from usuario as u join login as l on u.email=l.fkemailusuario;
 
            
select*
from usuario;

select rol 
from usuario 
where email = 'cliente' and clave = md5('cliente');

select*
from login;



