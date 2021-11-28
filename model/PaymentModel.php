<?php

require_once 'BaseModel.php';

class PaymentModel extends BaseModel {

    public function getReservaFromId(string $reserva_id): array {
        $query = 'call GR_getReserva(?)';
        $param = array($reserva_id);

        $response = $this->database->executeQueryParams($param, $query);

        if (!empty($response)) {
            return $response[0];
        } else {
            ErrorController::showError("Algo salió mal");
            die();
        }
    }

    public function getCheckinValidacion(string $reserva_id): array {
        $query = 'call GR_validacionCheckinExistente(?)';
        $param = array($reserva_id);

        $response = $this->database->executeQueryParams($param, $query);

        return $response;
    }

    public function getUserFromId(string $usuario_id): array {
        $query= "SELECT nombre, apellido, email FROM usuario 
             WHERE id = ? ";

        $response= $this->database->executeQueryParams(array($usuario_id), $query);

        if (!empty($response)) {
            return $response[0];
        } else {
            ErrorController::showError();
        }
    }
}