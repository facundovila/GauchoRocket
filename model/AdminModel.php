<?php

require_once "BaseModel.php";

class AdminModel extends BaseModel{

    public function crearReservasYUbicacionesParaUnVuelo($codigoVuelo){
       
        $query = 'call GR_capacidadTotalXVuelo(?)';
        $params = array($codigoVuelo);

        $response = $this->database->executeQueryParams($params,$query);
        
        $ubicaciones["cantidad"] = $response;

        for ($i = 1 ; $i <= $ubicaciones["cantidad"]; $i++){
            $numeroAlfanumerico = substr(str_shuffle($caracteresPermitidos),0,8);

            $reserva = "INSERT INTO reserva (idViaje, asiento, codigoAlfanumerico)
            values ('".$idDelVuelo."' , '".$i."', '".$numeroAlfanumerico."')";

            $this->database->agregar($reserva);
        }

    }

   
}


?>