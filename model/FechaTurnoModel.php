<?php
require_once "BaseModel.php";

class FechaTurnoModel extends BaseModel
{
    public function getFechaMedica($id): array {
        $query = "SELECT fechaTurnoMedico FROM turnoMedico WHERE fkIdUsuario = ?";

        $response= $this->database->executeQueryParams(array($id), $query);
        $data["turnosacado"]=$response;

        return $data;

    }

    public function getNivelVuelo($id): array {

        $query = "SELECT nivel,descripcion
                  from nivelVuelo as NV 
                  inner join nivelVueloUsuario as NVU on NVU.fkNivelVuelo=NV.codigo where NVU.fkIdUsuario = ?";

        $response= $this->database->executeQueryParams(array($id), $query);
        $data["Nivel"]=$response;

        return $data;
         
    }

}