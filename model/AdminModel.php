<?php

require_once "BaseModel.php";

class AdminModel extends BaseModel{

    public function crearReservasParaVuelo($matriculaEquipo,$codigoVuelo){
        $consulta = "SELECT capacidad from aeronave where idAeronave = '".$idAeronave."'";
        $capacidadDeLaAeronave =  $this->database->obtenerArrayRegistro($consulta);
        $caracteresPermitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        for ($i = 1 ; $i <= $capacidadDeLaAeronave["capacidad"]; $i++){
            $numeroAlfanumerico = substr(str_shuffle($caracteresPermitidos),0,8);

            $reserva = "INSERT INTO reserva (idViaje, asiento, codigoAlfanumerico)
            values ('".$idDelVuelo."' , '".$i."', '".$numeroAlfanumerico."')";

            $this->database->agregar($reserva);
        }

    }

   
}


?>