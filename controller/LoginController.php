<?php

require_once "BaseController.php";

class LoginController extends BaseController
{
    private LoginModel $loginModel;

    public function __construct($loginModel, $printer) {
        parent::__construct($printer);
        $this->loginModel = $loginModel;
    }

    public function show() {
        /* if (isset($_SESSION['role'])) {
             header("Location: /home"); } */
        echo $this->printer->render("view/loginView.html");
    }

    public function login() {
        if (!isset($_POST["login"])) {
            header("Location: /login");
        }

        $usuario = $_POST["usuario"];
        $clave = md5($_POST["password"]);

        $result = $this->loginModel->login($usuario, $clave);

        if (empty($result)) {
            die("Algo salió mal.");
        }

        $result = $result[0];
        $hash = $result["hash"];

        $_SESSION["id"] = $result["id"];
        $_SESSION["rol"] = $result["rol"];

        if ($hash == null) {
            header("Location: /home");
        } else {
            header("Location: /validator/show/hash=" . $hash);
        }
    }
}