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

    public function getVuelos(){
        $query = "SELECT Origen,Destino,t1.Nombre from
        (SELECT distinct t.nombre as Nombre,l.nombre as Origen
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (SELECT distinct t.nombre as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre";

        $response=$this->database->query($query);

        $data["Vuelos"]=$response;
        
        return $data;
    }
}