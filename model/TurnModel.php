<?php

require_once "BaseModel.php";

class TurnModel extends BaseModel {
    public function getCentrosMedicos(): array {
        $query = "select * from centroMedico as CM join locacion l on CM.codigoLocacion = l.codigo where CM.turnos > (select count(fechaTurnoMedico) from turnoMedico)";
        return $this->database->query($query);
    }

    public function registrarTurno($id, $date, $centroId) {
        $query = "INSERT INTO turnomedico (fkIdUsuario, fechaTurnoMedico, codigoLocacion) VALUES (?, ?, ?)";

        $this->database->executeQueryParams(array($id, $date, $centroId), $query);
    }

    public function setUserLevel($id, $nivel) {
        $query = "UPDATE usuario SET nivelVuelo = $nivel WHERE id = $id";
        $this->database->execute($query);
    }

    public function checkNivelVuelo($id): array {
        $query = "SELECT * FROM usuario WHERE id = ? AND nivelVuelo IS NOT NULL";
        return $this->database->executeQueryParams(array($id), $query);
    }
}