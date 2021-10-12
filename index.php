<?php
session_start();
include_once("config/Configuration.php");

$module = $_GET["module"] ?? "login";
$action = $_GET["action"] ?? "show";

$configuration = new Configuration();

$router = $configuration->createRouter( "createLoginController", "show");

$router->executeActionFromModule($module,$action);