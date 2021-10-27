<?php

require_once "BaseController.php";

class TurnController extends BaseController {
    private TurnModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {
        $response = $this->model->getCentrosMedicos();

        if (empty($response)) {
            $data["no-disponible"] = true;
        } else {
            $data["centros"] = $response;
        }

        echo $this->printer->render("view/turnView.html", $data);
    }

    public function sacarTurno() {
        $id = $_SESSION["id"];
        $date = $_POST["date"];
        $centroId = $_POST["centro"];

        $this->model->registrarTurno($id, $date, $centroId);

        $random = rand(0, 100);

        if ($random > 60) {
            $nivel = "3";
        } else if ($random > 10) {
            $nivel = "2";
        } else {
            $nivel = "1";
        }

        $this->model->setUserLevel($id, $nivel);

        $data["nivel"] = $nivel;

        echo $this->printer->render("view/nivelVueloView.html", $data);
    }
}