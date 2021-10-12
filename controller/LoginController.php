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

        $result = $this->loginModel->login($usuario, $clave);

        if (!empty($result)) {
            $hash = $result[0]["hash"];

            if ($hash == null) {
                header("Location: /home");
            } else {
                header("Location: /validator/show/hash=" .$hash);
            }
        } else {
            header("Location: /login");
        }
    }
}