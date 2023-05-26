<?php

class PedidosModel {
    function __construct() {
        $this->cnx = new MySqlDB();
    }

    function getPedidosPendientes() {
        $sql = "SELECT * FROM pedidos WHERE estado <> 'entregado'";
        $data = $this->cnx->query($sql);
        $pedidos =  $this->converAsocToObj($data);
        return $pedidos;
    }

    function getPedidosPendientesByIdUsuario(string $id_usuario) {
        $sql = "SELECT * FROM pedidos 
                INNER JOIN clientes ON clientes.id_cliente = pedidos.id_cliente  
                WHERE clientes.id_usuario = ? AND estado <> 'entregado'";
        $data = $this->cnx->query($sql, [$id_usuario]);
        return $this->converAsocToObj($data);
    }

    function getPedido(string $id_pedido) {
        $sql = "SELECT * FROM pedidos WHERE id_pedido = ?";
        $data = $this->cnx->query($sql, [$id_pedido]);
        $pedido =  $this->converAsocToObj($data);
        return empty($pedido) ? null : $pedido[0];
    }

    function getProductosPedido(string $id_pedido) {
        $sql = "SELECT * FROM pedidos_productos PP 
                INNER JOIN productos P ON P.id_producto = PP.id_producto 
                WHERE id_pedido = ?";
        $data = $this->cnx->query($sql, [$id_pedido]);
        $productos =  $this->converAsocToObjPedidoProducto($data);
        return $productos;
    }

    function crearPedido(string $id_cliente) {
        $sql = "INSERT INTO pedidos (id_cliente, estado) 
                VALUES (?,?)";
        $params = [$id_cliente, "pagado"];
        $ok = $this->cnx->execute($sql, $params);
        return $ok ? $this->cnx->lastInsertId() : false;
    }

    function addProductosPedido(string $id_pedido, array $carrito) {
        if (!empty($carrito)) {
            $sql = "INSERT INTO pedidos_productos 
                (id_pedido, Id_producto, cantidad) 
                VALUES ";
            $params = [];
            for ($i = 1; $i <= count($carrito); $i++) {
                $sql .= "(?,?,?)";
                if ($i < count($carrito)) {
                    $sql .= ", ";
                }
                $params[] = $id_pedido;
                $params[] = $carrito[$i - 1]["id"];
                $params[] = $carrito[$i - 1]["cantidad"];
            }
        }
        $ok = $this->cnx->execute($sql, $params);
        return $ok;
    }
    /**
     * Cambia el estado de un pedido.
     * 
     * @param string $id_pedido identificador del pedido.
     * @param string $estado nuevo estado del pedido (pagado, preparado, enviado, entregado)
     * 
     * @return boolean true si se ha realizado el cambio.
     */
    function cambiarEstado(string $id_pedido, string $estado) {
        $sql = "UPDATE pedidos SET estado = ? WHERE id_pedido = ?";
        $ok = $this->cnx->execute($sql, [strtolower($estado), $id_pedido]);
        return $ok;
    }
    /**
     * Convierte un array de elementos asociativos a un
     * array de objetos pedidos.
     */
    function converAsocToObj(array $asocs) {
        $objs = [];
        foreach ($asocs as $asoc) {
            $objs[] = new Pedido($asoc);
        }
        return $objs;
    }

    /**
     * Convierte un array de elementos asociativos a un
     * array de objetos pedidos.
     */
    function converAsocToObjPedidoProducto(array $asocs) {
        $objs = [];
        foreach ($asocs as $asoc) {
            $objs[] = new PedidoProducto($asoc);
        }
        return $objs;
    }
}
