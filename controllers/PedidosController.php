<?php

/**
 * Controlador para pedidos.
 */
class PedidosController {

    function __construct() {
        $this->model = new PedidosModel();
        $this->clientesModel = new ClientesModel();
    }

    /**
     * Lista de productos disponibles segun el rol de usuario
     * 
     * 
     */
    function index() {
        if (!isset($_SESSION["autenticado"])) {
            header("location: " . Config::URL_BASE);
        }
        if ($_SESSION["rol"] === "administrador") {
            $pedidos = $this->model->getPedidosPendientes();
        } else if ($_SESSION["rol"] === "cliente") {
            $pedidos = $this->model->getPedidosPendientesByIdUsuario($_SESSION["id"]);
        } else {
            header("location: " . Config::URL_BASE);
        }
        $vista = new View();
        $vista->pedidos = $pedidos;
        $vista->render("pedidos");
    }

    function info(string $id_pedido) {
        $vista = new View();
        $vista->total = 0;
        $pedido = $this->model->getPedido($id_pedido);
        $vista->pedido = $pedido;
        $vista->cliente = $this->clientesModel->getCliente($pedido->idCliente);
        $detalles = $this->model->getProductosPedido($pedido->id);
        foreach ($detalles as $detalle) {
            $vista->total += $detalle->total;
        }
        $vista->detalles = $detalles;
        $vista->url_back = Config::URL_BASE . '/pedidos';
        $vista->render('pedidos_info');
    }

    function estado(string $estado) {
        if (!isset($_GET["id_pedido"])) {
            header("location: " . Config::URL_BASE . "/pedidos");
        }
        $id_pedido = $_GET["id_pedido"];
        $this->model->cambiarEstado($id_pedido, $estado);
        header("location: " . Config::URL_BASE . "/pedidos/info/$id_pedido");
    }
}
