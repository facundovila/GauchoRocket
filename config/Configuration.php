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
        return new HomeController($this->createPrinter());
    }

    private function createLoginModel(): LoginModel {
        require_once "model/LoginModel.php";
        $database = $this->getDatabase();
        return new LoginModel($database);
    }

    private function createRegisterModel(): RegisterModel {
        require_once "model/RegisterModel.php";
        $database = $this->getDatabase();
        return new RegisterModel($database);
    }

    private function getDatabase(): MyDatabase {
        require_once("helpers/MyDatabase.php");
        $config = $this->getConfig();
        return new MyDatabase($config["servername"], $config["username"], $config["password"], $config["dbname"]);
    }

    private function getConfig(): bool|array {
        if( is_null( $this->config ))
            $this->config = parse_ini_file("config/config.ini");

        return  $this->config;
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
        return new MustachePrinter("view/partials");
    }

}