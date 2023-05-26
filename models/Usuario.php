<?php

class Usuario {
    function __construct(array $data) {
        if (isset($data["id_usuario"])) {
            $this->id = $data["id_usuario"];
        }
        $this->nombre = $data["nombre"];
        $this->email = $data["email"];
        $this->password = $data["password"];
        if (isset($data["rol"])) {
            $this->rol = $data["rol"];
        }
    }

    function encriptarPassword() {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }
}
