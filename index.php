<?php
session_start();
include_once("config/Configuration.php");

$module = $_GET["module"] ?? "home";
$action = $_GET["action"] ?? "show";

$configuration = new Configuration();

$router = $configuration->createRouter( "createHomeController", "show");

$router->executeActionFromModule($module,$action);