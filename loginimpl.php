<?php

require_once ("establecerConexion.php");
require_once("Usuario.php");

session_start();

if(isset($_POST["login"])){
    $usuario=$_POST["usuario"];
    $clave=md5($_POST["password"]);
}

echo json_encode($_POST) ."<br>";

$consulta = "SELECT * FROM usuario where usuario = ? and clave = ?";

$comm = $db->prepare($consulta);

$comm->bind_param("ss",$usuario,$clave);
$comm->execute();
$resultado= $comm->get_result();

$res = $resultado->fetch_assoc();
echo json_encode($res) ."<br>";

$db->close();

if($res==true){
    echo "bienvenido a gaucho rocket " . $usuario ."<br>";
    $_SESSION["usuario"] = $usuario;

    echo json_encode($_SESSION);
    header("Location: index.php");
} else {
    echo "no existe " . $usuario;
}

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










