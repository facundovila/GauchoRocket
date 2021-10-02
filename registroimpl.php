<?php

require_once ("Registrar.php");

if(isset($_POST["usuario"]).isset($_POST["password"]).isset($_POST["mail"])){
    $usuario=$_POST["usuario"];
    $password=$_POST["password"];
    $email=$_POST["mail"];
}


$nuevoUsuario= new Registrar($usuario,$password,$email);

$db= new mysqli("localhost", "root","","db",3308);

if($db->connect_error){
    echo "ha ocurrido un error: " .$db->connect_error;
}

$consulta= " INSERT INTO usuario (usuario, clave, email) VALUES (?,?,?)";

$comm= $db->prepare($consulta);
$comm->bind_param("sss" , $usuario,$password,$email);
$comm->execute();
$resultado= $comm->get_result();


