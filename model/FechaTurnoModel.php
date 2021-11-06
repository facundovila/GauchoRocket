<?php
require_once "BaseModel.php";

class FechaTurnoModel extends BaseModel
{
    public function GetFechaMedica($id): array {
        $query = "SELECT fechaTurnoMedico FROM turnomedico WHERE fkIdUsuario = ?";

        $response= $this->database->executeQueryParams(array($id), $query);
        $data["turnosacado"]=$response;

        return $data;

    }

}