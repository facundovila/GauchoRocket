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
             $codigo = $_GET['codigo'];

             $result = $this->vuelosModel->validarNivelVueloUsuario($id, $codigo);

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

     public function asignarReserva() {
         $usuarioId = $_SESSION["id"];
        // $codigoUbicacion =(int) $_POST["ubicacion_vuelo"];
        // $codigoServicio = (int) $_POST["codigoS"];

         $_SESSION['codigoS']=(int) $_POST["servicios"];
         $_SESSION['codigoC']=(int) $_POST["cabinas"];


         echo $this->printer->render("view/verAsientosView.html");

        // $this->vuelosModel->asignarReserva($usuarioId,$codigoUbicacion);

        // header("location: /reservar");
     }
}