<?php

require_once 'BaseController.php';
require_once 'ErrorController.php';

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

            $codigoCheckIn = $this->model->doCheckin($codigoReserva);
            if (!empty($codigoCheckIn)) {
                $reserva = $this->model->getReservaFromId($codigoReserva);
                $origen = $reserva['origen'];
                $destino = $reserva['destino'];
                $fecha = $reserva['fecha'];
                $precio = $reserva['precio'];

                $this->model->sendCheckIn($codigoCheckIn, $codigoReserva, $origen, $destino, $fecha, $precio);
            } else {
                ErrorController::showError("Algo salió mal");
                die();
            }
        }

        header("location: /MisReservas");

    }
}