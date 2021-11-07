<?php

require_once "BaseModel.php";

class VuelosModel extends BaseModel{


    public function getVuelos(){

        $query = "SELECT codigo,Origen,Destino,t1.Nombre from
        (select distinct t.nombre as Nombre,l.nombre as Origen
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,t.nombre as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre";

        $response=$this->database->query($query);

        $data["Vuelos"]=$response;
        
        return $data;
    }


}

?>