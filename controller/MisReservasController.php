<?php

require_once 'BaseController.php';

class MisReservasController extends BaseController {
    private MisReservasModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {
        $usuarioId = $_SESSION["id"];
        $data["reservas"] = $this->model->getReservas($usuarioId);

        echo $this->printer->render("view/misReservasView.html", $data);
    }

    public function eliminarReserva(){

        if(isset($_GET['codigoReserva'])){

            $codigoReserva = $_GET['codigoReserva'];

            $this->model->deleteReserva($codigoReserva);

        }

        echo $this->printer->render("view/misReservasView.html");

        

    }
}