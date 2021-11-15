<?php

require_once "BaseModel.php";

class VuelosModel extends BaseModel{

    public function getVuelos(){
      
        $query = 'call GR_todosLosVuelos';

        $response=$this->database->query($query);

        $data["vuelos"]=$response;
        
        return $data;
    }

    public function getVuelosDisponibles($origen, $destino, $fecha_partida, $tipo): array {
      
        $query = 'call GR_todosLosVuelosTodosLosParametros(?,?,?,?)';
        $params = array($origen, $destino, $fecha_partida, $tipo);

        $response = $this->database->executeQueryParams($params,$query);
        
        $data["vuelos"] = $response;

        return $data;
    }


    public function getdatosUsuario($id):array{

        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";


        $response= $this->database->executeQueryParams(array($id),$query);

        $data["datosUsuario"]=$response;

        return $data;



    }

    public function getReserva($codigo):array{

        $query= "SELECT codigo,origen,destino,t1.Nombre as nombre,fecha,precio from
        (select distinct v.descripcion as Nombre,l.nombre as Origen,fecha, v.precio as precio
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionOrigen=l.codigo) as t1
        inner join
        (select distinct t.codigo,v.descripcion as nombre,l.nombre as Destino
        from vuelo as v
        inner join trayecto as t on v.codigoTrayecto=t.codigo
        inner join locacion as l on t.codigoLocacionDestino=l.codigo) as t2
        on t1.nombre=t2.nombre where codigo = ?";


        $response= $this->database->executeQueryParams(array($codigo),$query);

        $data["reserva"]=$response;

        return $data;







    }
}