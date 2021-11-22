<?php

require_once "BaseModel.php";

class LoginModel extends BaseModel {

    public function login($usuario, $password) {
        $query=  "select id, rol, hash from usuario as u join login as l on u.email=l.fkemailusuario
                  where u.usuario = ? and u.clave = ?";

        $params = array($usuario, $password);

        return $this->database->executeQueryParams($params, $query);
    }
}