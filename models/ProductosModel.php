<?php

class ProductosModel {
    function __construct() {
        $this->cnx = new MySqlDB();
        $this->pageSize = 3;
    }

    function getProductos() {
        $sql = "SELECT * FROM productos";
        $prods = $this->cnx->query($sql);
        return $this->converAsocToObj($prods);
    }

    function getNumeroPaginasTotales() {
        $sql = "SELECT COUNT(*) as Total FROM productos";
        $data = $this->cnx->query($sql);
        $total = $data[0]["Total"];
        return intval(ceil($total / $this->pageSize));
    }

    function getProductosByPage($page) {

        $salto = ($page - 1) * $this->pageSize;
        $sql = "SELECT * FROM productos LIMIT $salto, $this->pageSize";
        $prods = $this->cnx->query($sql);
        return $this->converAsocToObj($prods);
    }

    function getProducto(int $id_producto) {
        $sql = "SELECT * FROM productos WHERE id_producto=?";
        $prods = $this->cnx->query($sql, [$id_producto]);
        return empty($prods) ? null : new Producto($prods[0]);
    }

    function getProductosCarrito(array $carrito) {
        $sql = "SELECT * FROM productos WHERE ";
        for ($i = 0; $i < count($carrito); $i++) {
            $sql .= ("id_producto = " . $carrito[$i]["id"]);
            if ($i < count($carrito) - 1) {
                $sql .= " OR ";
            }
        }
        $data = $this->cnx->query($sql);
        $prods = $this->converAsocToObj($data);
        return $prods;
    }

    function getProductosByBusqueda(string $busqueda) {
        $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
        $prods = $this->cnx->query($sql, ["%$busqueda%"]);
        return $this->converAsocToObj($prods);
    }


    function createProducto(Producto $producto) {
        $sql = "INSERT INTO productos (nombre, stock, marca, 
        precio, descripcion, categoria, peso, imagen) 
        VALUES (?,?,?,?,?,?,?,?)";
        $params = [
            $producto->nombre,
            $producto->stock,
            $producto->marca,
            $producto->precio,
            $producto->descripcion,
            $producto->categoria,
            $producto->peso,
            $producto->imagen
        ];
        $ok = $this->cnx->execute($sql, $params);
        return $ok ? $this->cnx->lastInsertId() : false;
    }

    function updateProducto(Producto $producto) {
        $sql = "UPDATE productos SET nombre = ?, stock = ?, 
            marca = ?, precio=?, descripcion=?, categoria=?,
            peso=?, imagen=? WHERE id_producto=?";
        $params = [
            $producto->nombre,
            $producto->stock,
            $producto->marca,
            $producto->precio,
            $producto->descripcion,
            $producto->categoria,
            $producto->peso,
            $producto->imagen,
            $producto->id
        ];
        $ok = $this->cnx->execute($sql, $params);
        return $ok;
    }

    function deleteProducto(int $id_producto) {
        $sql = "DELETE FROM productos WHERE id_producto=?";
        $ok = $this->cnx->execute($sql, [$id_producto]);
        return $ok;
    }

    /**
     * Convierte un array de elemtos asociativos a un
     * array de objetos productos.
     */
    function converAsocToObj(array $asocs) {
        $objs = [];
        foreach ($asocs as $asoc) {
            $objs[] = new Producto($asoc);
        }
        return $objs;
    }
}
