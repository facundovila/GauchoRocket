<?php
class Configuration{

    private $config;

    public function createLoginController(): LoginController {
        require_once "controller/LoginController.php";
        return new LoginController($this->createLoginModel(), $this->createPrinter());
    }

    public function createRegisterController(): RegisterController {
        require_once "controller/RegisterController.php";
        return new RegisterController($this->createRegisterModel(), $this->createPrinter());
    }

    public function createHomeController(): HomeController {
        require_once "controller/HomeController.php";
        return new HomeController($this->createHomeModel(),$this->createPrinter());
    }

    public function createValidatorController(): ValidatorController {
        require_once "controller/ValidatorController.php";
        return new ValidatorController($this->createValidatorModel(), $this->createPrinter());
    }

    public function createTurnController(): TurnController {
        require_once "controller/TurnController.php";
        return new TurnController($this->createTurnModel(), $this->createPrinter());
    }

    public function createUserController(): UserController{
        require_once "controller/UserController.php";
        return new UserController($this->createUserModel(), $this->createPrinter());

    }
    private function createLoginModel(): LoginModel {
        require_once "model/LoginModel.php";
        $database = $this->getDatabase();
        return new LoginModel($database);
    }

    private function createHomeModel(): HomeModel {
        require_once "model/HomeModel.php";
        $database = $this->getDatabase();
        return new HomeModel($database);
    }

    private function createRegisterModel(): RegisterModel {
        require_once "model/RegisterModel.php";
        $database = $this->getDatabase();
        return new RegisterModel($database);
    }

    private function createValidatorModel() {
        require_once "model/ValidatorModel.php";
        $database = $this->getDatabase();
        return new ValidatorModel($database);
    }

    private function createTurnModel(): TurnModel {
        require_once "model/TurnModel.php";
        $database = $this->getDatabase();
        return new TurnModel($database);
    }

    private function createUserModel(): UserModel{
        require_once "model/UserModel.php";
        $database= $this->getDatabase();
        return new UserModel($database);

    }

    private function getDatabase(): MyDatabase {
        require_once("helpers/MyDatabase.php");
        $config = $this->getConfig();
        return new MyDatabase($config["servername"], $config["username"], $config["password"], $config["dbname"],$config["port"]);
    }

    private function getConfig(): bool|array {
        if( is_null( $this->config ))
            $this->config = parse_ini_file("config/config.ini");

        return  $this->config;
    }

    private function getLoginCheck(){
        require_once("helpers/LoginCheck.php");
        
    }

    private function getLogger(): Logger {
        require_once("helpers/Logger.php");
        return new Logger();
    }

    public function createRouter($defaultController, $defaultAction): Router {
        include_once("helpers/Router.php");
        return new Router($this,$defaultController,$defaultAction);
    }

    private function createPrinter(): MustachePrinter {
        require_once ('third-party/mustache/src/Mustache/Autoloader.php');
        require_once("helpers/MustachePrinter.php");
        return new MustachePrinter("view/partials", $this->createLoginChecker());
    }

    private function createLoginChecker(): LogginChecker {
        require_once "helpers/LoginCheck.php";

        return new LogginChecker();
    }
}