<?php

require_once "BaseModel.php";

class TurnModel extends BaseModel {
    public function getCentrosMedicos(): array {
        $query = "SELECT * from centroMedico as CM join locacion l on CM.codigoLocacion = l.codigo";
        
        return $this->database->query($query);
    }

    public function registrarTurno($id, $date, $centroId) {
        $query = "INSERT INTO turnoMedico (fkIdUsuario, fechaTurnoMedico, codigoLocacion) VALUES (?, ?, ?)";

        $this->database->executeQueryParams(array($id, $date, $centroId), $query);
    }

    public function setUserLevel($id, $nivel) {
        $query = "INSERT INTO nivelVueloUsuario(fkIdUsuario,fkNivelVuelo)values (?, ?)";

        $this->database->executeQueryParams(array($id, $nivel), $query);
    }

    public function checkNivelVuelo($id): array {

        $query = "SELECT * from usuario as U
         join nivelVueloUsuario as NVU on U.id=NVU.fkIdUsuario 
         join nivelVuelo as NV on NVU.fkNivelVuelo=NV.nivel WHERE U.id= ?";

        return $this->database->executeQueryParams(array($id), $query);

    }

    public function checkFechaTurno($centroId,$date){
        if($centroId=13){
            $centroId=3;
        }

        $query = "SELECT distinct codigo as id, turnos,codigoLocacion as Locacion
        from centroMedico as CM where CM.codigo = ? and CM.turnos > 
        (select distinct count(fechaTurnoMedico) from turnoMedico where fechaTurnoMedico = ? )";

        return $this->database->executeQueryParams(array($centroId,$date), $query);
    }

    public function GetFechaMedica($id): array {
    $query = "SELECT fechaTurnoMedico FROM turnoMedico WHERE fkIdUsuario = ?";

    $response= $this->database->executeQueryParams(array($id), $query);
    $data["fechaturno"]=$response;

    return $data;

    }


}