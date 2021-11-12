<?php

require_once 'BaseController.php';

class ReservarController extends BaseController {
    private ReservarModel $model;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->model = $model;
    }

    public function show() {
        //$codigoVuelo = $_GET["codigoVuelo"];
        //echo $codigoVuelo;
        $id = $_SESSION["id"];

        $datosUsuario= $this->model->getdatosUsuario($id);

        $data["datosUsuario"]=$datosUsuario;

        echo $this->printer->render("view/reservarView.html",$data);

    }
}