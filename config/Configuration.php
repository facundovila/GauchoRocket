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
    public function createFechaTurnoController(): FechaTurnoController{
        require_once "controller/FechaTurnoController.php";
        return new FechaTurnoController($this->createFechaTurnoModel(), $this->createPrinter());

    }
    public function createVuelosController(): VuelosController{
        require_once "controller/VuelosController.php";
        return new VuelosController($this->createVuelosModel(),$this->createPrinter());
    }

    public function createReservarController(): ReservarController {
        require_once 'controller/ReservarController.php';
        return new ReservarController($this->createReservaModel(), $this->createPrinter());
    }

    public function createAdminController(): AdminController {
        require_once 'controller/AdminController.php';
        return new AdminController($this->createAdminModel(), $this->createPrinter());
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
        $sendmail = $this->getSendMailHelper();
        return new RegisterModel($database, $sendmail, $this->getBaseUrl());
    }

    private function createValidatorModel(): ValidatorModel {
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
    private function createFechaTurnoModel(): FechaTurnoModel{
        require_once "model/FechaTurnoModel.php";
        $database= $this->getDatabase();
        return new FechaTurnoModel($database);

    }
    private function createVuelosModel(): VuelosModel{
        require_once "model/VuelosModel.php";
        $database= $this->getDatabase();
        return new VuelosModel($database);
    }

    private function createReservaModel(): ReservarModel {
        require_once 'model/ReservarModel.php';
        $database= $this->getDatabase();
        return new ReservarModel($database);
    }

    private function createAdminModel(): AdminModel {
        require_once 'model/AdminModel.php';
        $database= $this->getDatabase();
        return new AdminModel($database);
    }

    private function getDatabase(): MyDatabase {
        require_once("helpers/MyDatabase.php");
        $config = $this->getConfig();
        return new MyDatabase($config["servername"], $config["username"], $config["password"], $config["dbname"],$config["port"]);
    }

    private function getSendMailHelper(): SendMail {
        require_once "helpers/SendMail.php";
        $config = $this->getConfig();
        return new SendMail($this->getLogger(), $config["email"], $config["email_password"]);
    }

    private function getBaseUrl(): string {
        $config = $this->getConfig();
        return $config["base_url"];
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