<?php

class LoginModel {
    private MyDatabase $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function login($email) {
        $query = "SELECT * FROM usuario WHERE email = ?";
        $params = array($email);

        return $this->database->query($params, $query);

        /*$consulta = "SELECT * FROM usuario where usuario = ? and clave = ?";

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
        }*/
    }
}