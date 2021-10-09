<?php

require_once "BaseController.php";

class RegisterController extends BaseController {
    private RegisterModel $registerModel;

    public function __construct($registerModel, $printer) {
        parent::__construct($printer);
        $this->registerModel = $registerModel;
    }

    public function show() {
        echo $this->printer->render( "view/registroView.html");
    }

    public function register() {
        if (!isset($_POST["registro"])) {
            echo "Error";
            die();
        }

        //echo json_encode($_POST) ."<br>";

        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        echo json_encode($this->registerModel->registerUser($usuario, $email, md5($password)));
    }
}