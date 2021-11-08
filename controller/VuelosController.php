<?php

require_once "BaseController.php";

 class VuelosController extends BaseController {
     private VuelosModel $vuelosModel;

    public function __construct($vuelosModel, $printer) {
        parent::__construct($printer);
        $this->vuelosModel = $vuelosModel;
    }

    public function show() {
        $data=$this->vuelosModel->getVuelos();
        
        echo $this->printer->render("view/vuelosView.html",$data);
    }

    public function showFlights() {
        $origen = $_POST["origen"];
        $destino = $_POST["destino"];
        $fecha_partida = $_POST["fecha_partida"];
        $clase = $_POST["clase"];

        $data = $this->vuelosModel->getVuelosDisponibles($origen, $destino, $fecha_partida, $clase);

        echo $this->printer->render("view/vuelosView.html", $data);
    }
}