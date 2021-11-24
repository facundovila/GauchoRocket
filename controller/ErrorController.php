<?php

require_once 'BaseController.php';

class ErrorController extends BaseController {

    public function show() {
        $data = [];
        $data["title"] = $_GET["title"] ?? "Error";
        $data["error"] = $_GET["error"] ?? "error";

        echo $this->printer->render("view/errorView.html", $data);
    }

    public static function showError(string $error, string $title = "Error") {
        header("location: /error?title=" .$title ."&error=" .$error);
        exit();
    }
}
