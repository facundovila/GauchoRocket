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
            session_destroy();
            header('Location: /');
            exit();
        }
   
        if (isset($_SESSION["rol"])&&$_SESSION["rol"]=="cliente") {
            $data["logged"]=true;
         
        }else if(isset($_SESSION["rol"])&&$_SESSION["rol"]=="admin"){
            $data["admin"]=true;
        }
        else {
            $data["notLogged"]= true;
            
        }
        return $data;

    }
 }