<?php

require_once "BaseModel.php";
require_once 'helpers/QRGenerator.php';
require_once 'controller/ErrorController.php';
require_once 'helpers/CheckingHTMLGenerator.php';

class CheckinModel extends BaseModel {
    private SendMail $sendMail;

    public function __construct($database, $sendMail) {
        parent::__construct($database);
        $this->sendMail = $sendMail;
    }

    public function sendCheckIn($codigoCheckIn, $codigoReserva, $origen, $destino, $fecha, $cabina, $servicio, $descripcion, $asiento) {
        $id = $_SESSION['id'];

        $query = 'SELECT email, nombre, apellido FROM usuario where id = ?';
        $params = array($id);

        $response = $this->database->executeQueryParams($params, $query);

        if (!empty($response)) {
            $email = $response[0]['email'];
            $nombre = $response[0]['nombre'];
            $apellido = $response[0]['apellido'];

            $qrGenerator = new QRGenerator();
            $qr = $qrGenerator->getQRUrl($codigoCheckIn);
            $html = CheckingHTMLGenerator::generateHTML($qr, $codigoReserva, $origen, $destino, $fecha, $nombre, $apellido, $cabina, $servicio, $descripcion, $asiento);

            $this->sendMail->sendMail($email, $nombre .' ' .$apellido, 'CheckIn: ' . $origen . '-' . $destino, $html);
        } else {
            ErrorController::showError("Algo salió mal");
        }
    }

    public function doCheckin(string $codigoReserva): string {
        $query = "call GR_realizarCheckIn(?)";
        $param = array($codigoReserva);

        $response = $this->database->executeQueryParams($param, $query);

        if (!empty($response)) {
            return $response[0]['codigo'];
        } else {
            return '';
        }
    }

    public function getReservaFromId(string $codigoReserva) {
        $query = 'call GR_getReserva(?)';
        $param = array($codigoReserva);

        $response = $this->database->executeQueryParams($param, $query);

        if (!empty($response)) {
            return $response[0];
        } else {
            ErrorController::showError("Algo salió mal");
            die();
        }
    }
}