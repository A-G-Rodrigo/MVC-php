<?php

class Pedido {
    function __construct(array $data) {
        if (isset($data["id_pedido"])) {
            $this->id = $data["id_pedido"];
        }
        $this->idCliente = $data["id_cliente"];
        $this->fechaCompra = $data["fecha_compra"];
        $this->estado = $data["estado"];
        $this->fechaEntrega = $data["fecha_entrega"];
    }

    function setIdCliente(string $value) {
        $this->idCliente = $value;
    }
    function setIdPedido(string $value) {
        $this->id = $value;
    }
}
