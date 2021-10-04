<?php

$db=new mysqli("localhost","root","11037","dbgr"); //nombre servidor,nombre usuario,contraseña,schema

if($db->connect_error){
    echo "ha ocurrido un error: " . $db->connect_error;
    die("Ha Ocurrido un error al conectarse con la Base de Datos");
}

?>