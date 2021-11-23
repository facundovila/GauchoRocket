<?php

require_once 'BaseModel.php';

class MisReservasModel extends BaseModel {

    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function deleteReserva(string $codigoReserva) {
        $query = "call GR_desalocarReserva(?)";
        $param = array($codigoReserva);

        $this->database->executeQueryParams($param, $query);
    }
}