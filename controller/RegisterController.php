<?php

require_once "BaseController.php";

class RegisterController extends BaseController {
    private RegisterModel $registerModel;

    public function __construct($registerModel, $printer) {
        parent::__construct($printer);
        $this->registerModel = $registerModel;
    }

    public function show() {
        if (isset($_SESSION['rol'])) {
            header("Location: /home");
        }

        echo $this->printer->render("view/registroView.html");
    }

    public function register() {
        if (!isset($_POST["registro"])) {
            echo "Error";
            die();
        }

        $usuario = $_POST["usuario"];
        $email = $_POST["email"];
        $password = md5( $_POST["password"]);
        $hash = md5(date('h:i:s', time()));
        
        $this->registerModel->registerUser($usuario,$email,$password);
        $this->registerModel->registerLogin($email,$password,$hash);

        $this->registerModel->sendAuthentication($usuario, $email, $hash);

        header("Location: /validator/show");
    }
}