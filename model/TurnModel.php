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
        $query = "INSERT INTO nivelVueloUsuario(fkIdUsuario,fkNivelVuelo)values (?, ?)";

        $this->database->executeQueryParams(array($id, $nivel), $query);
    }

    public function checkNivelVuelo($id): array {

        $query = "SELECT * from Usuario as U
         join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario 
         join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel WHERE U.id= ?";
        return $this->database->executeQueryParams(array($id), $query);

   
    }

    /*
    public function checkFechaTurno($date){
        $query = 
    }

    */
}