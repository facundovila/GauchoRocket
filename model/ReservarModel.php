<?php

require_once 'BaseModel.php';

class ReservarModel extends BaseModel {
    public function getdatosUsuario($id):array{

        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";



        return $this->database->executeQueryParams(array($id),$query);



    }

    public function getReserva($id):array{

        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";



        return $this->database->executeQueryParams(array($id),$query);



    }
}