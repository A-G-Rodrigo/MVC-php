<?php

class HomeController {

    function index() {
        $vista = new View();
        $vista->render("home");
    }
}
