<?php

include ("establecerConexion.php");
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
/*
$consultaCrearUsuario= " INSERT INTO usuario (usuario, clave, email) VALUES (?,?,?)";

$comm= $db->prepare($consultaCrearUsuario);
$comm->bind_param("sss" , $usuario,$clave,$email);
$comm->execute();
$resultado= $comm->get_result();
*/
// Comentado, siempre va a ser false por ser un insert   

// se crea el cliente ligado al usuario recien creado

$consultaCrearCliente= " INSERT INTO cliente (fkemailusuario) VALUES (?)";

$comm= $db->prepare($consultaCrearCliente);
$comm->bind_param("s",$email);
$comm->execute();

// se inicia la sesion del cliente al terminar el registro

$consultaCrearLogin= " INSERT INTO login (fkemailusuario,clave) VALUES (?,?)";

$comm= $db->prepare($consultaCrearLogin);
$comm->bind_param("ss",$email,$clave);
$comm->execute();

// se cierra la bd

$db->close();
