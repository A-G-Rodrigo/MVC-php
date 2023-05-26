<?php

class ClientesController {

    function __construct() {
        $this->model = new ClientesModel();
        $this->usuariosModel = new UsuarioModel();
    }

    function index() {
        $vista = new View();
        $vista->render("clientes");
    }

    function nuevo() {
        if (!isset($_SESSION["autenticado"])) {
            header("location: " . Config::URL_BASE . "/login");
        }
        $vista = new View();
        try {
            if (isset($_POST["enviar"])) {
                $valido = new ClienteFormValidator($_POST);
                if ($valido->isOK()) {
                    $cliente = new Cliente($_POST);
                    $cliente->setIdUsuario($_SESSION["id"]);
                    $id = $this->model->createCliente($cliente);
                    if ($id !== false) {
                        $ok = $this->usuariosModel->cambiarRol($_SESSION["id"], "cliente");
                        if ($ok) {
                            $_SESSION["rol"] = 'cliente';
                        }
                        $_POST = [];
                    } else {
                        $vista->err_msg = "No se ha podido guardar los datos. Inténtelo de nuevo.";
                    }
                }
            }
        } catch (ClienteFormValidatorException $e) {
            $errores = $e->getMessagesErrores();
            $vista->errores = $errores;
        } finally {
            $vista->render("clientes_new");
        }
    }

    function info(string $id_cliente) {
        $vista = new View();
        $vista->cliente = $this->model->getCliente($id_cliente);
        $vista->url_back = Config::URL_BASE . '/pedidos';
        $vista->render('clientes_info');
    }
}
