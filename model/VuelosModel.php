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
}