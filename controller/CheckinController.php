<?php

require_once 'BaseController.php';

class CheckinController extends BaseController {
    private CheckinModel $model;

    public function __construct(MustachePrinter $printer, CheckinModel $model) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {
        if(isset($_GET['codigoReserva'])){

            $codigoReserva = $_GET['codigoReserva'];

            $codigoCheckIn = $this->model->doCheckin($codigoReserva);
            if (!empty($codigoCheckIn)) {
                $reserva = $this->model->getReservaFromId($codigoReserva);
                $origen = $reserva['origen'];
                $destino = $reserva['destino'];
                $fecha = $reserva['fecha'];
                $servicio = $reserva['servicio'];
                $cabina = $reserva['cabina'];
                $descripcion = $reserva['descripcion'];
                $asiento = $reserva['asiento'];

                $this->model->sendCheckIn($codigoCheckIn, $codigoReserva, $origen, $destino, $fecha, $cabina, $servicio, $descripcion, $asiento);
            } else {
                ErrorController::showError("Algo salió mal");
                die();
            }
        }

        header("location: /MisReservas");
    }
}