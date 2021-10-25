<?php

require_once "BaseModel.php";

class HomeModel extends BaseModel {

    public function clienteBase() {
        $usuario='cliente';
        $con='cliente';
        $query=  "select rol from usuario 
                  where email = '".$usuario."' and clave = md5( '".$con."')";

        
                  
        return $this->database->execute($query);

       
    }
}