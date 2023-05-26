<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="<?= Config::URL_BASE . "/estilos.css" ?>">
</head>

<body>
    <div class="main-container">
        <header class="cabecera">
            <div>
                <h1 class="cabecera_titulo">Tienda virtual</h1>
            </div>
            <div class="cabecera_right">
                <p class="cabecera_usuario"><?= $_SESSION["nombre"] ?? '' ?></p>
                <a class="cabecera_link <?= isset($_SESSION["autenticado"]) ? 'ocultar' : '' ?>" href="<?= Config::URL_BASE . '/login' ?>">Login</a>
                <a class="cabecera_link <?= isset($_SESSION["autenticado"]) ? 'ocultar' : '' ?>" href="<?= Config::URL_BASE . '/registro' ?>">Registro</a>
                <a class="cabecera_link <?= isset($_SESSION["autenticado"]) && $_SESSION["rol"] != "administrador" ? '' : 'ocultar' ?>" href="<?= Config::URL_BASE . '/carrito' ?>">Carrito</a>
                <a class="cabecera_link <?= isset($_SESSION["autenticado"]) ? '' : 'ocultar' ?>" href="<?= Config::URL_BASE . '/login/cerrar' ?>">Salir</a>
            </div>
        </header>
        <nav class="nav nav-bc-sienna">
            <ul class="nav_list nav-list-jc-around">
                <li class="nav_item"><a class="nav_link" href="<?= Config::URL_BASE ?>">Inicio</a></li>
                <li class="nav_item"><a class="nav_link" href="<?= Config::URL_BASE . "/productos" ?>">Productos</a></li>
                <li class="nav_item"><a class="nav_link" href="<?= Config::URL_BASE . "/clientes" ?>">Clientes</a></li>
                <li class="nav_item"><a class="nav_link" href="<?= Config::URL_BASE . "/pedidos" ?>">Pedidos</a></li>
            </ul>
        </nav>