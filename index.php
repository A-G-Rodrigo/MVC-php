<?php
require_once "./libs/Autoload.php";
Autoload::init();
//require_once "./config/Config.php";
session_start();
require "./views/cabecera.php";
if (isset($_GET["url"])) {
    // echo $_GET["url"];
    $url = explode("/", $_GET["url"]);
    // var_dump($url);
    $controlador = 'Home';
    $accion = 'index';
    $id = 0;

    if (count($url) == 1) {
        $controlador = $url[0];
    } else if (count($url) == 2) {
        $controlador = $url[0];
        $accion = $url[1];
    } else if (count($url) == 3) {
        $controlador = $url[0];
        $accion = $url[1];
        $id = $url[2];
    } else {
        echo "Error 404. Página no encontrada.";
    }

    $class_name = ucwords($controlador) . "Controller";
    try {
        $obj = new $class_name;
        if (method_exists($obj, $accion)) {
            call_user_func([$obj, $accion], $id);
        } else {
            echo "Página no encontrada 404";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
        // echo "Página no encontrada 404";
    }
} else {
    $ctrl = new HomeController();
    $ctrl->index();
};

include "./views/pie.php";
