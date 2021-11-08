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

    public function getLocacion(){

        $query = "SELECT codigo,nombre from locacion where nombre <> 'Shanghai' ";

        $response=$this->database->query($query);

        $data["Locaciones"]=$response;

        return $data;
    }


    public function getTiposTrayecto(){

        $query = "SELECT codigo,nombre from tipoDeTrayecto";

        $response=$this->database->query($query);

        $data["TiposT"]=$response;

        return $data;
    }
}