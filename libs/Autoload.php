<?php

class Autoload {

    public static function init() {
        spl_autoload_register(function ($nombre_clase) {
            $config = './config/' . $nombre_clase . '.php';
            $controller = './controllers/' . $nombre_clase . '.php';
            $libs = './libs/' . $nombre_clase . '.php';
            $models = './models/' . $nombre_clase . '.php';
            $existe = false;

            if (file_exists($config)) {
                require_once $config;
                $existe = true;
            }
            if (file_exists($controller)) {
                require_once $controller;
                $existe = true;
            }
            if (file_exists($libs)) {
                require_once $libs;
                $existe = true;
            }
            if (file_exists($models)) {
                require_once $models;
                $existe = true;
            }

            if (!$existe) {
                throw new Exception("Error 404. Página no encontrada. $nombre_clase");
            }
        });
    }
}
