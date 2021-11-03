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

        $data = $this->userModel->getDatosUserById($id);

        echo $this->printer->render("view/userView.html", $data);

    }
}