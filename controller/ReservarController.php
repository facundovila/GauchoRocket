<?php

require_once 'BaseController.php';

class ReservarController extends BaseController {
    private ReservarModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {
        $usuarioId = $_SESSION["id"];
        $data["reservas"] = $this->model->getReservas($usuarioId);

        echo $this->printer->render("view/misReservasView.html", $data);
    }
}