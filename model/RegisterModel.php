<?php

require_once "BaseModel.php";

class RegisterModel extends BaseModel {
    function registerUser($name, $email, $password, $hash) {
        $request = "INSERT INTO usuario (usuario, email, clave, hash) VALUES (?, ?, ?, ?)";
        $params = array($name, $email, $password, $hash);

        return $this->database->query($params, $request);
    }
}