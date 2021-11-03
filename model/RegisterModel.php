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

    function registerUser($name, $email, $password) {
        $request = "INSERT INTO usuario (usuario, email, clave) VALUES (?, ?, ?)";
        $params = array($name, $email, $password);

        return $this->database->executeQueryParams($params, $request);
    }

    function registerLogin($email,$password,$hash){
        $request = "INSERT INTO login (fkemailusuario,clave,hash) VALUES (?,?,?)";
        $params = array($email, $password,$hash);

       $this->database->executeQueryParams($params, $request);
    }

    function sendAuthentication($usuario, $email, $hash) {
        $message = '<a href="' .$this->baseurl .'/validator/validate/hash='. $hash . '">Validar</a>';
        $this->sendmail->sendMail($email, $usuario, "Autentificación", $message);
    }
}