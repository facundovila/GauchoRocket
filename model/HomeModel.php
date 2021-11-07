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

        $query = "SELECT codigo,nombre from locacion";

        $response=$this->database->query($query);

        $data["Locaciones"]=$response;

        return $data;
    }


    public function getCabinas(){

        $query = "SELECT codigoTipoDeCabina,descripcion from tipoDeCabina";

        $response=$this->database->query($query);

        $data["Cabinas"]=$response;

        return $data;

    }
}