<?php

class ListaCarrito {
    private $lista;
    private $total;

    function __construct(array $productos, array $carrito) {
        $this->lista = [];
        $this->total = 0;
        foreach ($carrito as $fila) {
            $p = $this->buscarProducto($fila["id"], $productos);
            $this->lista[] = [
                "id" => $p->id,
                "nombre" => $p->nombre,
                "precio" => $p->precio,
                "cantidad" => $fila["cantidad"],
                "total" => $p->precio * $fila["cantidad"]
            ];
            $this->total += $p->precio * $fila["cantidad"];
        }
    }

    function getLista() {
        return $this->lista;
    }

    function getTotal() {
        return $this->total;
    }

    private function buscarProducto(int $id, array $productos) {
        $encontrado = false;
        $i = 0;
        while ($i < count($productos) && !$encontrado) {
            if ($productos[$i]->id == $id) {
                $encontrado = true;
            } else {
                $i++;
            }
        }
        return $encontrado ? $productos[$i] : null;
    }
}
