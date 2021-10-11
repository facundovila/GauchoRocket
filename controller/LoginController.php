<?php

require_once "BaseController.php";

class LoginController extends BaseController {
    private LoginModel $loginModel;

    public function __construct($loginModel, $printer) {
        parent::__construct($printer);
        $this->loginModel = $loginModel;
    }

    public function show() {
        echo $this->printer->render( "view/loginView.html");
    }

    public function login() {
        if(!isset($_POST["login"])){
            header("Location: /login");
        }

        $usuario = $_POST["usuario"];
        $clave = md5($_POST["password"]);

        $result = $this->loginModel->login($usuario);


        echo json_encode($result) ."<br>";
        echo $result[0]["hash"];

        if (!empty($result)) {
            $hash = $result[0]["hash"];
            if ($hash == null) {
                header("Location: /home");
            } else {
                header("Location: /validar/hash=" .$hash);
            }
        } else {
            header("Location: /login");
        }
    }

    public function validar() {
        if (!isset($_GET["hash"])) {
            die("dasd");
        }

        $hash = $_GET["hash"];

        /*if ($this->loginModel->validar($hash)) {
            echo "sucess";
        } else {
            echo "error";
        }*/

        $this->loginModel->validar($hash);
        header("Location: /home");
    }
}