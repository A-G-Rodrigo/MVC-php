<?php

class CarritoController {

    function __construct() {
        $this->productosModel = new ProductosModel();
        $this->pedidosModel = new PedidosModel();
        $this->clientesModel = new ClientesModel();
    }
    function index() {
        $vista = new View();
        $vista->carrito = [];
        $vista->total = 0;
        $vista->classComprarLink = 'ocultar';
        if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
            $productos = $this->productosModel->getProductosCarrito($_SESSION["carrito"]);
            $lista = new ListaCarrito($productos, $_SESSION["carrito"]);
            $vista->carrito = $lista->getLista();
            $vista->total = $lista->getTotal();
            $vista->classComprarLink = '';
        }
        $vista->render('carrito');
    }

    function add(string $id_producto) {
        if (isset($_SESSION["carrito"])) {
            $_SESSION["carrito"][] = ["id" => $id_producto, "cantidad" => 1];
        } else {
            $_SESSION["carrito"] = [
                ["id" => $id_producto, "cantidad" => 1]
            ];
        }
        header("Location: " . Config::URL_BASE . "/carrito");
    }

    function quitar(string $id_producto) {
        $carrito = $_SESSION["carrito"];
        $newCarrito = [];
        foreach ($carrito as $e) {
            if ($e["id"] != $id_producto) {
                $newCarrito[] = $e;
            }
        }
        $_SESSION["carrito"] = $newCarrito;
        header("location: " . Config::URL_BASE . "/carrito");
    }

    function comprar() {
        if (!isset($_SESSION["autenticado"])) {
            header("location: " . Config::URL_BASE . "/login");
        }
        if ($_SESSION["rol"] != 'cliente') {
            header("location: " . Config::URL_BASE . "/clientes/nuevo");
        }
        $cliente = $this->clientesModel->getClienteByIdUsuario($_SESSION["id"]);
        if (!is_null($cliente)) {
            $id_pedido = $this->pedidosModel->crearPedido($cliente->id);
            if ($id_pedido !== false) {
                $ok = $this->pedidosModel->addProductosPedido($id_pedido, $_SESSION["carrito"]);
                if ($ok) {
                    unset($_SESSION["carrito"]);
                    // header("location: " . Config::URL_BASE);
                }
            }
        }
    }
}
