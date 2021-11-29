<?php

require_once "BaseModel.php";

class TurnModel extends BaseModel {
    public function getCentrosMedicos(): array {
        $query = "SELECT * from centroMedico as CM join locacion l on CM.codigoLocacion = l.codigo";
        
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

    public function checkFechaTurno($centroId,$date){
        
        $query = "call GR_checkFechaTurno(?, ?)";

        return $this->database->executeQueryParams(array($centroId,$date), $query);
    }

    public function GetFechaMedica($id): array {
        $query = "SELECT fechaTurnoMedico FROM turnomedico WHERE fkIdUsuario = ?";

        $response= $this->database->executeQueryParams(array($id), $query);
        $data["fechaturno"]=$response;

        return $data;

    }

    public function getDatosMail($userId){
        
        $query = "call GR_fechaYNivelMail(?)";

        $response=$this->database->executeQueryParams(array($userId), $query);

        return $response[0];
    }

    


}