<?php

class ConfigPath {

    function __construct() {
        $this->path_base = $_SERVER["DOCUMENT_ROOT"];
        $this->path_imagenes = $_SERVER["DOCUMENT_ROOT"] . "/imagenes";
    }
}
