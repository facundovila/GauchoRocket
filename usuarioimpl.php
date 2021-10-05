<?php

require_once ("establecerConexion.php");
require_once ("usuario.php");

if(isset($_POST["registro"])){
    $usuario=$_POST["usuario"];
    $clave=md5($_POST["password"]);
    $email=$_POST["mail"];
}



// Verificacion de email no registrado

$verificacionEmailNuevo= " SELECT * FROM usuario WHERE email= ? ";

$comm0= $db->prepare($verificacionEmailNuevo); 
$comm0->bind_param("s",$email);
$comm0->execute();
$resultEmail=$comm0->get_result();

if($user=mysqli_fetch_assoc($resultEmail)){
    if($user['email'] == $email){
        echo "email ya registrado";

    }else
    $nuevoUsuario=new Usuario($usuario,$clave,$email);
}


// se crea el usuario en la bd

$consultaCrearUsuario= " INSERT INTO usuario (usuario, clave, email) VALUES (?,?,?)";

$comm1= $db->prepare($consultaCrearUsuario);
$comm1->bind_param("sss" , $usuario,$clave,$email);
$comm1->execute();


// Comentado, siempre va a ser false por ser un insert  $resultado= $comm1->get_result();

// se crea el cliente ligado al usuario recien creado

$consultaCrearCliente= " INSERT INTO cliente (fkemailusuario) VALUES (?)";

$comm2= $db->prepare($consultaCrearCliente);
$comm2->bind_param("s",$email);
$comm2->execute();

// se inicia la sesion del cliente al terminar el registro

$consultaCrearLogin= " INSERT INTO login (fkemailusuario,clave) VALUES (?,?)";

$comm3= $db->prepare($consultaCrearLogin);
$comm3->bind_param("ss",$email,$clave);
$comm3->execute();

// se cierra la bd

$db->close();
