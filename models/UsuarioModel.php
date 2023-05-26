<?php

class UsuarioModel {

    function __construct() {
        $this->cnx = new MySqlDB();
    }

    function createUsuario(Usuario $usr) {
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) 
        VALUE (?,?,?,?)";
        $params = [
            $usr->nombre,
            $usr->email,
            $usr->password,
            'usuario'
        ];
        $ok = $this->cnx->execute($sql, $params);
        return $ok;
    }

    function getUsuarioByEmail(string $email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $data = $this->cnx->query($sql, [$email]);
        return empty($data) ? null : new Usuario($data[0]);
    }

    function cambiarRol(string $id_usuario, string $new_rol) {
        $sql = "UPDATE usuarios SET rol = ? WHERE id_usuario = ?";
        $params = [
            $new_rol,
            $id_usuario
        ];
        $ok = $this->cnx->execute($sql, $params);
        return $ok;
    }
}
