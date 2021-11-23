<?php

require_once "BaseModel.php";

class AdminModel extends BaseModel{

    public function getVuelosSinPasajes(){
      
        $query = 'call GR_todosLosVuelos'; // Crear Procedure para esto, temporal

        $response=$this->database->query($query);

        $data["vuelos"]=$response;
        
        return $data;
    }

    public function createReservasYUbicacionesParaUnVuelo($codigoVuelo){
       
          $query = 'call GR_ejecutarReservas(?)';
          $params = array($codigoVuelo);

          $response = $this->database->executeQueryParams($params,$query);
          
          $data["Reservas"] = $response;

          return $data;

        }

    

   
}


?>