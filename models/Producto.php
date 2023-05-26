<?php

class Producto {

    function __construct(array $data) {
        if (isset($data["id_producto"])) {
            $this->id = $data["id_producto"];
        }
        $this->nombre = $data["nombre"];
        $this->stock = $data["stock"];
        $this->marca = $data["marca"];
        $this->precio = $data["precio"];
        $this->descripcion = $data["descripcion"];
        $this->categoria = $data["categoria"];
        $this->peso = $data["peso"];
        if (isset($data["imagen"])) {
            $this->imagen = $data["imagen"];
        }
    }

    public function setIdProducto(int $value) {
        $this->id = $value;
    }
    public function setNombreImagen(string $value) {
        $this->imagen = $value;
    }
}
