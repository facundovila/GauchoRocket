<?php
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

public function logout(){
    session_unset();
    session_destroy();
    header('Location: /');
    exit();
}