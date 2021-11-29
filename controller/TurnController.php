<?php

require_once "BaseController.php";
require_once 'helpers/TurnHTMLGenerator.php';

class TurnController extends BaseController {
    private TurnModel $model;
    private SendMail $sendMail;

    public function __construct($model, $printer, $sendMail) {
        parent::__construct($printer);
        $this->model = $model;
        $this->sendMail = $sendMail;
    }

    public function show() {
        $id = $_SESSION["id"];

        $nivelVuelo = $this->model->checkNivelVuelo($id);



        if (!empty($nivelVuelo)) {

            header("location: /fechaTurno/");
        }

        $response = $this->model->getCentrosMedicos();

        if (empty($response)) {
            $data["no-disponible"] = true;

        } else {
            $data["centros"] = $response;

        }
        echo $this->printer->render("view/turnView.html", $data);

    }





    public function sacarTurno() {
        $id = $_SESSION["id"];

        $nivelVuelo = $this->model->checkNivelVuelo($id);

        if (!empty($nivelVuelo)) {
            header("location: /");
        }

        $date = $_POST["date"];
        $centroId = $_POST["centro"];

        $fechaValida=$this->model->checkFechaTurno($centroId,$date);
        if(empty($fechaValida)){
            $data["no-disponible"] = true;
            echo $this->printer->render("view/turnView.html", $data);
        }
        else{

        $this->model->registrarTurno($id, $date, intval($centroId));

        $random = rand(0, 100);

        if ($random >= 60) {
            $nivel = "3";
        } else if ($random >= 10) {
            $nivel = "2";
        } else {
            $nivel = "1";
        }

        $this->model->setUserLevel($id, $nivel);

        $data["nivel"] = $nivel;

        $this->enviarTurnoMail();

        echo $this->printer->render("view/nivelVueloView.html", $data);
        }
    }

    public function enviarTurnoMail(){

        $id = $_SESSION["id"];

        $datosTurno = $this->model->getDatosMail($id);
        $fechaTurno = $datosTurno['fechaTurno'];
        $locacion = $datosTurno['locacion'];
        $descripcion = $datosTurno['descripcion'];  
        $nivel = $datosTurno['nivel'];
        $nombre = $datosTurno['nombre'];
        $apellido = $datosTurno['apellido'];
        $email= $datosTurno['email'];

        $html = TurnHTMLGenerator::generateHTML($fechaTurno, $locacion, $descripcion, $nivel, $nombre, $apellido);

        $this->sendMail->sendMail($email, $nombre .' ' .$apellido, 'Su Turno Medico', $html);

    }
}