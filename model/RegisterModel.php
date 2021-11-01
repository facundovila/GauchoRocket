<?php

require_once "BaseModel.php";

class RegisterModel extends BaseModel {

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
    
}