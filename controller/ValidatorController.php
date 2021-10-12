<?php

require_once "BaseController.php";

class ValidatorController extends BaseController {
    private ValidatorModel $validatorModel;

    public function __construct($model, $printer) {
        parent::__construct($printer);
        $this->validatorModel = $model;
    }

    public function show() {
        if (!isset($_GET["hash"])) {
            header("Location: /login");
        } else {
            $data = $_GET["hash"];

            echo $this->printer->render("view/validarView.html", $data);
        }
    }

    public function validate() {
        if (!isset($_GET["hash"])) {
            die("Algo salió mal.");
        }

        $hash = $_GET["hash"];

        $this->validatorModel->validate($hash);
        header("Location: /home");
    }
}
