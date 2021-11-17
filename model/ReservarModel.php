<?php

require_once 'BaseModel.php';

class ReservarModel extends BaseModel {
    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        $data = $this->database->executeQueryParams($param, $query);
        die(json_encode($data));

        return $data;
    }
}