<?php

require_once "BaseController.php";

class LoginController extends BaseController {
    private LoginModel $loginModel;

    public function __construct($loginModel, $printer) {
        parent::__construct($printer);
        $this->loginModel = $loginModel;
    }

    public function show() {
       /* if (isset($_SESSION['role'])) {
            header("Location: /home"); } */
        echo $this->printer->render( "view/loginView.html");
    }

    public function login() {
        if(!isset($_POST["login"])){
            header("Location: /login");
        }

        $usuario = $_POST["usuario"];
        $clave = md5($_POST["password"]);

        $result = $this->loginModel->login($usuario, $clave);
      
      
       // echo "<br>" . json_encode($result) ."<br>";
        
      
        if (!empty($result)) {
            $hash = $result[0]["hash"];

            if ($hash == null) {
                $_SESSION["rol"]=json_encode($result);
                header("Location: /home");
            } else {
                $_SESSION["rol"]=json_encode($result);
                header("Location: /validator/show/hash=" .$hash);
            }
        } else {
            header("Location: /login");
        }
      
        
    }
}