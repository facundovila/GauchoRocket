<?php

require_once ("establecerConexion.php");
require_once("Usuario.php");

if(isset($_POST["login"])){
    $usuario=$_POST["usuario"];
    $clave=md5($_POST["password"]);
}


$consulta = "SELECT * FROM usuario where usuario = ? and clave = ?";

$comm = $db->prepare($consulta);

$comm->bind_param("ss",$usuario,$password);
$comm->execute();
$resultado= $comm->get_result();


if( $resultado->fetch_assoc()==true){
    echo "bienvenido a gaucho rocket " . $usuario;
}

$db->close();
/*while($fila = $resultado->fetch_assoc()){
    echo "bienvenido a gaucho rocket".$fila["usuario"];

} */



/*$query = $basedatos->query($consulta);
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










