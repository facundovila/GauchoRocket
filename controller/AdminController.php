<?php

require_once "BaseController.php";

 class AdminController extends BaseController {
     private AdminModel $adminModel;

    public function __construct($adminModel, $printer) {
        parent::__construct($printer);
        $this->adminModel = $adminModel;
    }

    public function show(){
    if(!isset($_SESSION["rol"])||$_SESSION["rol"]=="cliente"){

      header("Location:/home");

    }else{

      $data=$this->adminModel->getVuelosSinPasajes(); 

      echo $this->printer->render("view/adminView.html",$data);

    }

                       
    }

    public function createReservas(){

        $codigoVuelo= $_GET["codigoVuelo"];

        $this->adminModel->createReservasYUbicacionesParaUnVuelo($codigoVuelo);

    }

}

?>