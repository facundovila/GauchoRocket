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
         if (isset($_SESSION['rol'])) {
             header("Location: /home");
         }

        echo $this->printer->render("view/loginView.html");
    }

    public function login() {
        if (!isset($_POST["login"])) {
            header("Location: /login");
        }

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        if (empty($usuario)) {
            $this->showError($usuario, $password, "error-usuario", "El usuario ingresado no es válido");
            exit();
        }

        if ($password == null) {
            $this->showError($usuario, $password, "error-password", "La contraseña ingresada no es válida");
            exit();
        }

        $clave = md5($password);

        $result = $this->loginModel->login($usuario, $clave);

        if (empty($result)) {
            $this->showError($usuario, $password, "error", "Algo salió mal");
            exit();
        }

        $result = $result[0];
        $hash = $result["hash"];

        $_SESSION["id"] = $result["id"];
        $_SESSION["rol"] = $result["rol"];

        if ($hash == null || empty($hash)) {
            header("Location: /home");
        } else {
            header("Location: /validator/show/hash=" . $hash);
        }
    }

    private function showError($usuario, $password, $key, $message) {
        $data[$key] = $message;
        $data["usuario"] = $usuario;
        $data["password"] = $password;

        echo $this->printer->render("view/loginView.html", $data);
    }
}