<?php

require_once 'BaseModel.php';

class MisReservasModel extends BaseModel {

    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function getCheckin(string $usuarioId){
        $query = "call GR_getCheckIn(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function deleteReserva(string $codigoReserva) {
        $query = "call GR_desalocarReserva(?)";
        $param = array($codigoReserva);

        $this->database->executeQueryParams($param, $query);
    }

    public function doCheckin(string $codigoReserva){
        $query = "call GR_realizarCheckIn(?)";
        $param = array($codigoReserva);

        $this->database->executeQueryParams($param, $query);
    }
}