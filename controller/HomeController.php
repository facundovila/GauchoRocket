<?php

require_once "BaseController.php";

 class HomeController extends BaseController {
     private HomeModel $homeModel;

     public function __construct($homeModel, $printer) {
        parent::__construct($printer);
        $this->homeModel = $homeModel;
    }

     public function show() {
         $data = $this->loginCheck();
         echo $this->printer->render( "view/home.html",$data);
     }

     public function loginCheck() {

        if(isset($_GET["logout"])){
           // require_once "../helpers/logout.php"; arreglar
            session_start();
            session_destroy();
            header('Location: /');
            exit();
        }

        /*
        if(empty($_SESSION["cliente"])){
            $cliente = $this->homeModel->clienteBase();
            $_SESSION["cliente"]=json_encode($cliente);
        }
        echo $_SESSION["cliente"]."<br>";
        */
         
   
        if (isset($_SESSION["rol"])) {
            $data["logged"]=true;
         
        }
        /* 
        if(isset($_SESSION["rol"])&&$_SESSION["rol"]!=$_SESSION["cliente"]) {
              $data["admin"]=true;
            }  
            */  
        else {
            $data["notLogged"]= true;
            
        }
        return $data;

    }
 }