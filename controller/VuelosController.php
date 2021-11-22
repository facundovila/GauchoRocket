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
        $origen = (int) $_POST["origen"];
        $destino = (int) $_POST["destino"];
        $fecha_partida = $_POST["fecha_partida"];
        $clase = (int) $_POST["tipo"];
        

        var_dump($origen,$destino,$fecha_partida,$clase);

        $data = $this->vuelosModel->getVuelosDisponibles($origen, $destino, $fecha_partida, $clase);

        echo $this->printer->render("view/vuelosView.html", $data);
    }

    public function controlBrowser(){

        

    }

     public function datosReserva() {  // logout sigue roto desde este punto
         $id = $_SESSION["id"];

         $data[] = [];

         

         if(isset($_GET['codigo'])) {

             $_SESSION['codigoV']=$_GET['codigo'];
             
             $codigo = $_SESSION['codigoV'];
             

             $result = $this->vuelosModel->validarNivelVueloUsuario($id, $codigo); //implementar

             /*if(1 != ($result[0]['@resultado'])){
                 // TODO pantalla de error
                die("No podés reservar un pasaje para este vuelo");
             }*/

             $data["codigo_vuelo"] = $codigo;
             $data += $this->vuelosModel->getdatosUsuario($id);

             $data += $this->vuelosModel->getUbicaciones($codigo);

             $data += $this->vuelosModel->selectVuelo($codigo);
             $data += $this->vuelosModel->getCabinasYServicios();
         }

         echo $this->printer->render("view/reservarView.html", $data);
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