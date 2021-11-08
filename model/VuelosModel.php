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

        $data["vuelos"]=$response;
        
        return $data;
    }

    public function getVuelosDisponibles($origen, $destino, $fecha_partida, $clase): array {
        $query = "select codigo,origen,destino,t1.Nombre as nombre, fecha, precio, vueloId from
                        (select distinct t.nombre as Nombre,l.nombre as origen, fecha, t.precio as precio, v.codigo as vueloId
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionOrigen=l.codigo
                        inner join tipoDeTrayecto as TT on TT.codigo=t.codigoTipoDeTrayecto
                        where t.codigoLocacionOrigen= $origen /*and TT.nombre = 'SubOrbitales'*/ and fecha = '$fecha_partida') as t1
                        inner join
                        (select distinct t.codigo,t.nombre as nombre,l.nombre as destino
                        from vuelo as v
                        inner join trayecto as t on v.codigoTrayecto=t.codigo
                        inner join locacion as l on t.codigoLocacionDestino=l.codigo
                        where t.codigoLocacionDestino= $destino ) as t2
                        on t1.nombre=t2.nombre";

        $response = $this->database->query($query);
        $data["vuelos"] = $response;

        return $data;
    }
}