<?php
session_start();
include_once("config/Configuration.php");

$module = $_GET["module"] ?? "Login";
$action = $_GET["action"] ?? "show";

$configuration = new Configuration();

/*if ($_SESSION["usuario"] == null) {
    header("Location: view/login");
}*/

$router = $configuration->createRouter( "createLoginController", "show");

$router->executeActionFromModule($module,$action);