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
       
      //$query = 'call GR_capacidadTotalXVueloSoloCantidad(?)';
        $query = "call GR_capacidadTotalXVueloSoloCantidad('".$codigoVuelo."')";
      //$params = array($codigoVuelo);
 
      //$response = $this->database->executeQueryParams($params,$query);

        $response = $this->database->query($query);
        
        $ubicaciones["capacidad"]= $response;


        echo json_encode($ubicaciones["capacidad"]);
        die();
        

        for ($i = 1 ; $i <= $ubicaciones["capacidad"]; $i++){


            $queryUbicacion = "INSERT into ubicacion(asiento) values (?);";
            $paramsUbicacion = $i;
            $this->database->executeQueryParams($paramsUbicacion,$queryUbicacion);


            $querySelectLastUbicacion = "SELECT codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1";
            $lastUbicacion=$this->database->query($querySelectLastUbicacion);


            $queryInsertReserva = "INSERT into reservaPasaje (codigoReserva,fkCodigoUbicacion, codigoVuelo)
                                   values (substring(md5(now()),1,8),' ".$lastUbicacion."'.,' ".$codigoVuelo."')";
            $this->database->insertQuery($queryInsertReserva);


            $querySelectLastReserva = "SELECT codigoReserva from reservaPasaje order by codigoReserva desc limit 1";
            $lastReserva=$this->database->query($querySelectLastReserva);


            $queryInsertReserva = "insert into reservaUsuario(fkcodigoReserva) values ('".$lastReserva."')";
            $this->database->insertQuery($queryInsertReserva);
        }

    }

   
}


?>