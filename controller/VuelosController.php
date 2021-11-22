<?php

require_once "BaseController.php";
require_once 'ErrorController.php';

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
        $origen = (int) $_POST["origen"];
        $destino = (int) $_POST["destino"];
        $fecha_partida = $_POST["fecha_partida"];
        $tipo = (int) $_POST["tipo"];

        if (empty($this->vuelosModel->getLocacion($origen))) {
            ErrorController::showError("La ubicación de partida no existe");
        }

        if (empty($this->vuelosModel->getLocacion($destino))) {
            ErrorController::showError("La ubicación de destino no existe");
        }

        if (!$this->isValidDate($fecha_partida)) {
            ErrorController::showError("La fecha de partida no es válida");
        }

        if (!$this->$this->vuelosModel->getTipoDeTrayecto($tipo)) {
            ErrorController::showError("El tipo de trayecto no existe");
        }

        $data = $this->vuelosModel->getVuelosDisponibles($origen, $destino, $fecha_partida, $tipo);

        echo $this->printer->render("view/vuelosView.html", $data);
    }

    private function isValidDate($date): bool {
        $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
        $currentMillis = strtotime($dateTime->format("d-m-Y"));
        $millis = strtotime($date);

        return $millis >= $currentMillis;
    }

    public function controlBrowser(){

        

    }

     public function datosReserva() {  // logout sigue roto desde este punto
         $id = $_SESSION["id"];

         $data[] = [];

         $codigo = $_GET["codigo"];

         if ($codigo == null) {
             ErrorController::showError("El código es inválido");
         }

         $esNivelVueloValido = $this->vuelosModel->validarNivelVueloUsuario($id, $codigo);

         if (!$esNivelVueloValido) {
             ErrorController::showError("Este vuelo no está disponible para tu nivel de vuelo");
         }

         $data["codigo_vuelo"] = $codigo;
         $data += $this->vuelosModel->getdatosUsuario($id);

         $data += $this->vuelosModel->getUbicaciones($codigo);

         $data += $this->vuelosModel->selectVuelo($codigo);
         $data += $this->vuelosModel->getCabinasYServicios();

         echo $this->printer->render("view/reservarView.html", $data);
     }

     public function asignarReserva() {
         $usuarioId = $_SESSION["id"];
         $codigoUbicacion =(int) $_POST["ubicacion_vuelo"];

        

         $this->vuelosModel->asignarReserva($usuarioId,$codigoUbicacion);

         header("location: /reservar");
     }
}