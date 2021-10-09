<?php

require_once "BaseController.php";

 class HomeController extends BaseController {

     public function show() {
         echo $this->printer->render( "view/home.html");
     }
 }