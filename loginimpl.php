<?php

require_once("Usuario.php");

if(isset($_POST["usuario"]).isset($_POST["password"])){
    $usuario=$_POST["usuario"];
    $password=$_POST["password"];
}


$basedatos= new mysqli("localhost", "root","","db",3308);

if($basedatos->connect_error){
    echo "ha ocurrido un error: " .$basedatos->connect_error;
}


$consulta = "SELECT * FROM usuario where usuario = ? and clave = ?";
//$consulta = "INSERT INTO usuario where usuario = ? and clave = ?";

$comm = $basedatos->prepare($consulta);


$comm->bind_param("ss",$usuario,$password);
$comm->execute();
$resultado= $comm->get_result();


if( $resultado->fetch_assoc()==true){
    echo "bienvenido a gaucho rocket " . $usuario;
}

$basedatos->close();
/*while($fila = $resultado->fetch_assoc()){
    echo "bienvenido a gaucho rocket".$fila["usuario"];

} */



/*$queryy = $basedatos->query($consulta);
if($basedatos->error){
    echo "la consulta produjo un error :". $basedatos->error;
}
while($resultado=$queryy->fetch_assoc()){

 echo $resultado["usuario"] . "<br>";
}



if($usuario == "facu" && $password== "123456"){
    echo "bienvenido a GauchoRocket";
}else{
    echo "clave o usuario incorrectos";
} */










