<?php

require_once 'BaseModel.php';
require_once 'controller/ErrorController.php';

class MisReservasModel extends BaseModel {

    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function getCheckin(string $usuarioId,string $codigoReserva){
        $query = "call GR_getCheckIn(?, ?)";
        $params = array($usuarioId, $codigoReserva);

        $response = $this->database->executeQueryParams($params,$query)[0]["@resultado"];


        return $response == 1;
    }

    public function deleteReserva(string $codigoReserva) {
        $query = "call GR_desalocarReserva(?)";
        $param = array($codigoReserva);

        $this->database->executeQueryParams($param, $query);
    }

    public function getReservaFromId(string $codigoReserva) {
        $query = 'call GR_getReservaPDFedition(?)';
        $param = array($codigoReserva);

        $response = $this->database->executeQueryParams($param, $query);

        if (!empty($response)) {
           return $response[0];
        } else {
            ErrorController::showError("Algo salió mal");
            die();
        }
    }
}