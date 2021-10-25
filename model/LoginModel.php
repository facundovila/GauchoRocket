<?php

require_once "BaseModel.php";

class LoginModel extends BaseModel {

    public function login($email, $password) {
        $query=  "select rol from usuario as u join login as l on u.email=l.fkemailusuario
                  where u.email = ? and u.clave = ?";
        $params = array($email, $password);

        return $this->database->query($params, $query);
    }
}