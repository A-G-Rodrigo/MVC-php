<?php
class PedidoProducto {
    function __construct(array $data) {
        if (isset($data["id_pedido"])) {
            $this->id = $data["id_pedido"];
        }
        $this->producto = new Producto($data);
        $this->cantidad = $data["cantidad"];
        $this->total = $this->producto->precio * $this->cantidad;
    }

    function setIdPedido(string $value) {
        $this->id = $value;
    }
}
