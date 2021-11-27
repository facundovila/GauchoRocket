<?php

require_once 'BaseController.php';
require_once 'ErrorController.php';
require_once 'helpers/PdfPrinter.php';
require_once 'helpers/PDF_ReservaGenerator.php';

class MisReservasController extends BaseController {
    private MisReservasModel $model;

    public function __construct($model, $printer, $pdfPrinter) {
        parent::__construct($printer);
        $this->model = $model;
        $this->pdfPrinter = $pdfPrinter;

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

        header("location: /pagoReserva");

    }

    public function verReservaPDF(){  

        if(isset($_GET['codigoReserva'])){

            $codigoReserva = $_GET['codigoReserva'];

            $reserva = $this->model->getReservaFromId($codigoReserva);
            $pago = $reserva['pago'];
            $origen = $reserva['origen'];
            $destino = $reserva['destino'];  
            $fecha = $reserva['fecha'];
            $servicio = $reserva['servicio'];
            $cabina = $reserva['cabina'];
            $descripcion = $reserva['descripcion'];
            $asiento = $reserva['asiento'];

            $html= PDF_ReservaGenerator::generatePDF($codigoReserva, $origen, $destino, $fecha, $cabina, $servicio, $descripcion, $asiento, $pago);
            $this->pdfPrinter->printPDF($html);
        }

        header("location: /vuelos"); 

        }

     
}