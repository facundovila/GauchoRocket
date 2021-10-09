<?php

require_once "BaseModel.php";

class RegisterModel extends BaseModel {
    function registerUser($name, $email, $password) {
        $request = "INSERT INTO usuario (usuario, email, clave) VALUES (?, ?, ?)";
        $params = array($name, $email, $password);

        return $this->database->query($params, $request);
    }
}