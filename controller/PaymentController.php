<?php

require_once 'BaseController.php';

class PaymentController extends BaseController {
    private PaymentModel $model;
    private string $mpPublicKey;
    private string $mpAccessToken;
    private string $baseUrl;

    public function __construct(MustachePrinter $printer, PaymentModel $model, string $mpPublicKey,
                                string $mpAccessToken, string $baseUrl) {
        parent::__construct($printer);
        $this->model = $model;
        $this->mpPublicKey = $mpPublicKey;
        $this->mpAccessToken = $mpAccessToken;
        $this->baseUrl = $baseUrl;
    }

    public function show() {
        $usuario_id = $_SESSION["id"];

        if ($usuario_id == null) {
            ErrorController::showError('Necesitas haber iniciado sesión');
        }

        $usuario = $this->model->getUserFromId($usuario_id);

        if ($usuario == null) {
            ErrorController::showError('Algo salió mal');
        }

        $reserva_id = $_GET['reservaId'];

        if ($reserva_id == null) {
            ErrorController::showError('Algo salió mal');
        }

        $reserva = $this->model->getReservaFromId($reserva_id);

        if ($reserva == null) {
            ErrorController::showError('Algo salió mal');
        }

        require_once 'third-party/mercado-pago-sdk/vendor/autoload.php';
        MercadoPago\SDK::setAccessToken($this->mpAccessToken);

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();
        $item->title = 'Reserva';
        $item->quantity = 1;
        $item->unit_price = $reserva['precio'];

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();
        $preference->items = array($item);
        $preference->back_urls = array(
            "success" => $this->baseUrl . "/checkin?codigoReserva=" .$reserva_id,
            "failure" => $this->baseUrl . "/error?title=Falló el Pago&error=No se puedo terminar la operación",
            "pending" => $this->baseUrl . "/error?title=Pago&error=El pago está pendiente"
        );

        $preference->save();

        $data[] = [];
        $data["public_key"] = $this->mpPublicKey;
        $data["preference_id"] = $preference->id;
        $data["reserva"] = $reserva;
        $data["usuario"] = $usuario;

        echo $this->printer->render("view/paymentView.html", $data);
    }
}