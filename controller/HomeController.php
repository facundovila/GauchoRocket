<?php

require_once "BaseController.php";

 class HomeController extends BaseController {
     private HomeModel $homeModel;

     public function __construct($homeModel, $printer) {
        parent::__construct($printer);
        $this->homeModel = $homeModel;
    }

     public function show() {
         echo $this->printer->render( "view/home.html");
     }
 }