<?php

require_once "BaseController.php";

class UserController extends BaseController{
    private UserModel $userModel;


    public function __construct($userModel,$printer){
        parent::__construct($printer);
        $this->userModel = $userModel;

    }

    public function show(){
        $id = $_SESSION["id"];

        $datosUsuario = $this->userModel->getDatosUserById($id);
        $nivelVuelo = $this->userModel->getNivelVueloById($id);

        if(empty($nivelVuelo)){
            $data["datosUsuario"]=$datosUsuario;

        }else{
            $data["datosUsuario"]=$nivelVuelo;
        }



        echo $this->printer->render("view/userView.html", $data);

    }
}