<?php

class Cliente {
    function __construct(array $data) {
        if (isset($data["id_cliente"])) {
            $this->id = $data["id_cliente"];
        }
        $this->nombre = $data["nombre"];
        $this->apellidos = $data["apellidos"];
        $this->direccion = $data["direccion"];
        $this->telefono = $data["telefono"];
        $this->email = $data["email"];
        if (isset($data["id_usuario"])) {
            $this->idUsuario = $data["id_usuario"];
        }
    }

    function setIdCliente(string $value) {
        $this->id = $value;
    }
    function setIdUsuario(string $value) {
        $this->idUsuario = $value;
    }
}
