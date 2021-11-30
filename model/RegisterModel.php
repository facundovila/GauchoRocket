<?php

require_once "BaseModel.php";

class RegisterModel extends BaseModel {
    private SendMail $sendmail;
    private string $baseurl;

    public function __construct($database, $sendmail, $baseurl) {
        parent::__construct($database);
        $this->sendmail = $sendmail;
        $this->baseurl = $baseurl;
    }


    function registerUser($usuario, $email, $password, $nombre, $apellido, $dni, $telefono) {
        $request = "INSERT INTO usuario (usuario, email, clave, nombre, apellido, dni, telefono) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = array($usuario, $email, $password , $nombre, $apellido, $dni, $telefono);

        return $this->database->executeQueryParams($params, $request);
    }

    function registerLogin($email,$password,$hash){
        $request = "INSERT INTO login (fkemailusuario,clave,hash) VALUES (?,?,?)";
        $params = array($email, $password,$hash);

       $this->database->executeQueryParams($params, $request);
    }

    function sendAuthentication($usuario, $email, $hash) {
        $message = '<a href="' .$this->baseurl .'/validator/validate?hash='. $hash . '">Validar</a>';
        $this->sendmail->sendMail($email, $usuario, "Autentificación", $message);
    }
}