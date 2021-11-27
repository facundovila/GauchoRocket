<?php

require_once 'BaseModel.php';
require_once 'controller/ErrorController.php';
require_once 'helpers/CheckingHTMLGenerator.php';
require_once 'helpers/QRGenerator.php';

class MisReservasModel extends BaseModel {
    private SendMail $sendMail;

    public function __construct($database, $sendMail) {
        parent::__construct($database);
        $this->sendMail = $sendMail;
    }

    public function getReservas(string $usuarioId) {
        $query = "call GR_getReservasFromUserId(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function getCheckin(string $usuarioId){
        $query = "call GR_getCheckIn(?)";
        $param = array($usuarioId);

        return $this->database->executeQueryParams($param, $query);
    }

    public function deleteReserva(string $codigoReserva) {
        $query = "call GR_desalocarReserva(?)";
        $param = array($codigoReserva);

        $this->database->executeQueryParams($param, $query);
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