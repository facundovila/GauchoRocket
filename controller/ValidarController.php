<?php

require_once "BaseController.php";

class ValidarController extends BaseController {

    public function show() {
        //echo $this->printer->render( "view/validarView.html");
        header("Location: /login");
    }

    public function validar() {
        if (!isset($_GET["hash"])) {
            die("Algo salió mal");
        }

        $data = $_GET["hash"];

        echo $this->printer->render("view/validarView.html", $data);
    }
}
