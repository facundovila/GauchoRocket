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

        $email = $_POST["email"];
        $password = $_POST["password"];

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->showError($email, $password, "error-email", "El email ingresado no es válido");
            exit();
        }

        if ($password == null || strlen($password) < 6) {
            $this->showError($email, $password, "error-password", "La contraseña ingresada no es válida");
            exit();
        }

        $clave = md5($password);

        $result = $this->loginModel->login($email, $clave);

        if (empty($result)) {
            $this->showError($email, $password, "error", "Algo salió mal");
            exit();
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

    private function showError($email, $password, $key, $message) {
        $data[$key] = $message;
        $data["email"] = $email;
        $data["password"] = $password;

        echo $this->printer->render("view/loginView.html", $data);
    }
}