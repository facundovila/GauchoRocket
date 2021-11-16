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
         //$codigoVuelo = $_GET["codigoVuelo"];
         //echo $codigoVuelo;
         $id = $_SESSION["id"];
         $codigo = $_GET["codigo"];

         $result=$this->vuelosModel->validarNivelVueloUsuario($id,$codigo);

         if(1!=($result[0]['@resultado'])){
            header("location:/home");

            /* $data['nivelInvalido']=true;

            echo $this->printer->render("view/vuelosView.html",$data); */
         }

         $data= $this->vuelosModel->getdatosUsuario($id);
         
      //   $data+= $this->vuelosModel->getReserva($codigo); comentado por que no hace nada y rompe logout
         $data+= $this->vuelosModel->selectVuelo($codigo);
         $data+= $this->vuelosModel->getCabinasYServicios();
         //$data+= $this->vuelosModel->getServicios();


         echo $this->printer->render("view/reservarView.html",$data);

     }

}