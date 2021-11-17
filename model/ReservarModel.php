<?php

require_once 'BaseModel.php';

class ReservarModel extends BaseModel {
    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }
}