<?php

class LoginController {

    function __construct() {
        $this->model = new UsuarioModel();
    }
    function index() {
        try {
            $vista = new View();
            if (isset($_POST["enviar"])) {
                $usr = $this->model->getUsuarioByEmail($_POST["email"]);
                if (is_null($usr)) {
                    $vista->err_msg = "El usuario no existe.";
                } else {
                    $ok = password_verify($_POST["password"], $usr->password);
                    if ($ok) {
                        $_SESSION["id"] = $usr->id;
                        $_SESSION["rol"] = $usr->rol;
                        $_SESSION["nombre"] = $usr->nombre;
                        $_SESSION["autenticado"] = "true";
                        header("location: " . Config::URL_BASE . '/productos');
                    } else {
                        $vista->err_msg = 'Contraseña o e-mail inválido.';
                    }
                }
            }
        } catch (RegistroFormValidatorException $e) {
            $vista->errores = $e->getMessagesErrores();
        } catch (MySqlDBException $e) {
            $vista->err_msg = $e->getMessage();
        } finally {
            $vista->render('login');
        }
    }

    function cerrar() {
        if (isset($_SESSION["autenticado"])) {
            session_destroy();
        }
        header("location: " . Config::URL_BASE);
    }
}
