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


        /*echo json_encode($ubicaciones["capacidad"][0]["capacidad"]);
        die();*/

        $db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
        for ($i = 1 ; $i <= $ubicaciones["capacidad"][0]["capacidad"]; $i++){
            $queryUbicacion = "INSERT into ubicacion(asiento) values (?);";
            $paramsUbicacion = array($i);
            //$db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
            $db->executeQueryParams($paramsUbicacion,$queryUbicacion);

            $querySelectLastUbicacion = "SELECT codigoUbicacion from Ubicacion order by codigoUbicacion desc limit 1";
            //$db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
            $lastUbicacion=$db->query($querySelectLastUbicacion);

            $queryInsertReserva = "INSERT into reservaPasaje (codigoReserva,fkCodigoUbicacion, fkCodigoVuelo)
                                   values (substring(md5(now()), 1, 8),' ".$lastUbicacion[0]["codigoUbicacion"]."',' ".$codigoVuelo."')";

            //$db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
            $db->insertQuery($queryInsertReserva);

            $querySelectLastReserva = "SELECT codigoReserva from reservaPasaje order by codigoReserva desc limit 1";
            //$db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
            $lastReserva=$db->query($querySelectLastReserva);

            $queryInsertReserva = "insert into reservaUsuario(fkcodigoReserva) values ('".$lastReserva[0]["codigoReserva"]."')";
            //$db = new MyDatabase("localhost", "root", "root", "dbgr","3306");
            $db->insertQuery($queryInsertReserva);
        }

    }

   
}


?>