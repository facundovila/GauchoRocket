<?php
require_once "BaseController.php";
class FechaTurnoController extends BaseController{
   private FechaTurnoModel $fechaTurnoModel;


    public function __construct($fechaTurnoModel,$printer){
        parent::__construct($printer);
        $this->fechaTurnoModel = $fechaTurnoModel;

    }

    public function show(){
        $id = $_SESSION["id"];

        $data = $this->fechaTurnoModel->getFechaMedica($id);
        $data+= $this->fechaTurnoModel->getNivelVuelo($id);

        echo $this->printer->render("view/fechaTurnoView.html",$data);

    }
}