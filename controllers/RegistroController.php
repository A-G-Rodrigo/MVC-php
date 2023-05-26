<?php

class RegistroController {

    function __construct() {
        $this->model = new UsuarioModel();
    }
    function index() {
        try {
            $vista = new View();
            if (isset($_POST["enviar"])) {
                $ok = new RegistroFormValidator($_POST);
                if ($ok) {
                    $usr = new Usuario($_POST);
                    $usr->encriptarPassword();
                    $this->model->createUsuario($usr);
                }
            }
        } catch (RegistroFormValidatorException $e) {
            $vista->errores = $e->getMessagesErrores();
        } catch (MySqlDBException $e) {
            $vista->err_msg = $e->getMessage();
        } finally {
            $vista->render('registro');
        }
    }
}
