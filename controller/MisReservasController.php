<?php

require_once 'BaseController.php';

class MisReservasController extends BaseController {
    private MisReservasModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {

        if(empty($_SESSION["id"])){

            header ("location: /home");
        }

        $usuarioId = $_SESSION["id"];
        
        $data["reservas"] = $this->model->getReservas($usuarioId);
        

        echo $this->printer->render("view/misReservasView.html", $data);
    }

    public function eliminarReserva(){

        if(isset($_GET['codigoReserva'])){

            $codigoReserva = $_GET['codigoReserva'];

            $this->model->deleteReserva($codigoReserva);

        }

        header("location: /MisReservas");

    }

    public function checkin(){

        if(isset($_GET['codigoReserva'])){

            $codigoReserva = $_GET['codigoReserva'];

            $this->model->doCheckin($codigoReserva);

        }

        header("location: /MisReservas");

    }
}