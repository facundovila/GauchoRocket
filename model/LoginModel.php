<?php

require_once "BaseModel.php";

class LoginModel extends BaseModel {

    public function login($email, $password) {
        $query = "SELECT * FROM usuario WHERE email = ? AND clave = ?";
        $params = array($email, $password);

        return $this->database->query($params, $query);
    }
}