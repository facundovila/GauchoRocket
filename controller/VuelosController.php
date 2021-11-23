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
        $origen = (int) $_POST["origen"] ?? -1;
        $destino = (int) $_POST["destino"] ?? -1;
        $fecha_partida = $_POST["fecha_partida"];
        $tipo = (int) $_POST["tipo"] ?? -1;

        if (empty($this->vuelosModel->getLocacion((int) null))) {
            ErrorController::showError("La ubicación de partida no existe");
        }

        if (empty($this->vuelosModel->getLocacion($destino))) {
            ErrorController::showError("La ubicación de destino no existe");
        }

        if (!$this->isValidDateVuelo($fecha_partida)) {
            ErrorController::showError("La fecha de partida no es válida");
        }

        if (empty($this->vuelosModel->getTipoDeTrayecto($tipo))) {
            ErrorController::showError("El tipo de trayecto no existe");
        }

        $data = $this->vuelosModel->getVuelosDisponibles($origen, $destino, $fecha_partida, $tipo);

        echo $this->printer->render("view/vuelosView.html", $data);
    }

    private function isValidDateVuelo($date): bool {
        $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
        $currentMillis = strtotime($dateTime->format("d-m-Y"));
        $millis = strtotime($date);

        return $millis >= $currentMillis;
    }

    public function controlBrowser(){

        

    }

     public function datosReserva() {  // logout sigue roto desde este punto
         $id = $_SESSION["id"];
       
         if(isset($_GET['codigo'])) {

             $_SESSION['codigoV']=$_GET['codigo'];
             
             $codigo = $_SESSION['codigoV'];
           
         if ($codigo == null) {
             ErrorController::showError("El código es inválido");
         }
       
        
         $esNivelVueloValido = $this->vuelosModel->validarNivelVueloUsuario($id, $codigo);

         if (!$esNivelVueloValido) {
             ErrorController::showError("Este vuelo no está disponible para tu nivel de vuelo");
         }


         $data[] = [];

         $data += $this->vuelosModel->selectVuelo($codigo);

         if (empty($data["vueloSeleccionado"])) {
             ErrorController::showError("Algo salió mal");
         }

         $fecha = $data["vueloSeleccionado"][0]["fecha"];

         if (!$this->isValidDateReserva($fecha)) {
             ErrorController::showError("Las reservas sólo pueden realizarse hasta 24 horas antes del vuelo");
         }

         $data += $this->vuelosModel->getdatosUsuario($id);
         $data += $this->vuelosModel->getUbicaciones($codigo);
         $data += $this->vuelosModel->getCabinasYServicios();

         echo $this->printer->render("view/reservarView.html", $data);
     }


     private function isValidDateReserva($date) {
         $dateTime = new DateTime('now', new DateTimeZone('America/Argentina/Buenos_Aires'));
         $currentMillis = strtotime($dateTime->format("d-m-Y H:i:s"));
         $reservaMillis = strtotime('-1 day',strtotime($date));

         return $currentMillis <= $reservaMillis;
     }

     
     public function seleccionarServicioYCabina() {

         $usuarioId = $_SESSION["id"];

         $_SESSION['codigoS']=$_POST["servicios"];
         $_SESSION['codigoC']=$_POST["cabinas"];

         $data = $this->vuelosModel->getUbicacionesCabina($_SESSION['codigoV'],$_SESSION['codigoC']);

         
         echo $this->printer->render("view/verAsientosView.html", $data);

        
     }

     public function asignarReserva(){  

        if(isset($_POST["ubicacion_vuelo"])) {

        $usuarioId = $_SESSION["id"];
        $codigoUbicacion =$_POST["ubicacion_vuelo"];
        $codigoServicio = $_SESSION['codigoS'];

        $result = $this->vuelosModel->asignarReserva($usuarioId,$codigoUbicacion,$codigoServicio); 

        header("location: /reservar");

        session_unset('codigoS');
        session_unset('codigoC');
        session_unset('codigoV');

        }else{

        header("location: /vuelos"); //manejar vuelo sin lugares aca

        }

     }
}