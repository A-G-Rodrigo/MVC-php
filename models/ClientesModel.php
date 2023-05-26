<?php

class ClientesModel {
    function __construct() {
        $this->cnx = new MySqlDB();
    }

    function getCliente(string $id_cliente) {
        $sql = "SELECT * FROM clientes WHERE id_cliente = ?";
        $data = $this->cnx->query($sql, [$id_cliente]);
        return empty($data) ? null : new Cliente($data[0]);
    }

    function getClienteByIdUsuario(string $id_usuario) {
        $sql = "SELECT * FROM clientes WHERE id_usuario = ?";
        $data = $this->cnx->query($sql, [$id_usuario]);
        return empty($data) ? null : new Cliente($data[0]);
    }

    function createCliente(Cliente $cliente) {
        $sql = "INSERT INTO clientes (nombre, apellidos, direccion, 
        telefono, email, id_usuario) 
        VALUES (?,?,?,?,?,?)";
        $params = [
            $cliente->nombre,
            $cliente->apellidos,
            $cliente->direccion,
            $cliente->telefono,
            $cliente->email,
            $cliente->idUsuario
        ];
        $ok = $this->cnx->execute($sql, $params);
        return $ok ? $this->cnx->lastInsertId() : false;
    }
}
