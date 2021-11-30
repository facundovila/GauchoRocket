<?php

require_once "BaseController.php";
require_once "ErrorController.php";

 class AdminController extends BaseController {
     private AdminModel $adminModel;

    public function __construct($adminModel, $printer) {
        parent::__construct($printer);
        $this->adminModel = $adminModel;
    }

     public function show() {
         if (!isset($_SESSION["rol"]) || $_SESSION["rol"] == "cliente") {

             header("Location:/home");

         } else {

             $data = $this->adminModel->getVuelosSinPasajes();

             echo $this->printer->render("view/adminView.html", $data);

         }
     }

    public function createReservas(){

        $codigoVuelo= $_GET["codigoVuelo"];

        $this->adminModel->createReservasYUbicacionesParaUnVuelo($codigoVuelo);

        header("Location:/home"); // agregar algo que diga que se esta haciendo y redireccionar o algo

    }

    public function tasaDeOcupacionDelVuelo() {
        $codigoVuelo = $_GET["codigoVuelo"];

        if ($codigoVuelo == null) {
            ErrorController::showError();
        }

        $response = $this->adminModel->getTasaDeOcupacion($codigoVuelo);

        if (empty($response)) {
            ErrorController::showError();
        }

        $data = $response[0];

        echo $this->printer->render("view/tasaDeOcupacionDelVueloView.html", $data);
    }

    public function cabinasMasVendidas() {
        $response = $this->adminModel->getCabinasMasVendidas();

        if (empty($response)) {
            ErrorController::showError();
        }

        $data = $response[0];

        echo $this->printer->render("view/cabinasMasVendidasVIew.html", $data);
    }
}

?>