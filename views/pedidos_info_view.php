<main class="main-page">
    <h2 class="main-page_titulo">Detalle del pedido</h2>

    <div class="info mb-sm">
        <h3>Datos del pedido</h3>
        <div class="info_campo">
            <label class="info_label">ID pedido:</label>
            <p class="info_text"><?= $this->pedido->id ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Fecha de compra:</label>
            <p class="info_text"><?= $this->pedido->fechaCompra ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Estado:</label>
            <p class="info_text"><?= $this->pedido->estado ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Fecha de entrega:</label>
            <p class="info_text"><?= $this->pedido->fechaEntrega ?></p>
        </div>
        <div class="nav">
            <ul class="nav_list">
                <li class="nav_item mr-sm">
                    <a class="nav_link" href="<?= Config::URL_BASE . "/pedidos/estado/preparado?id_pedido=" . $this->pedido->id ?>">Preparado</a>
                </li>
                <li class="nav_item mr-sm">
                    <a class="nav_link" href="<?= Config::URL_BASE . "/pedidos/estado/enviado?id_pedido=" . $this->pedido->id ?>">Enviado</a>
                </li>
                <li class="nav_item mr-sm">
                    <a class="nav_link" href="<?= Config::URL_BASE . "/pedidos/estado/entregado?id_pedido=" . $this->pedido->id ?>">Entregado</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="info mb-sm">
        <h3>Datos del cliente</h3>
        <div class="info_campo">
            <label class="info_label">Nombre:</label>
            <p class="info_text"><?= $this->cliente->nombre ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Apellidos:</label>
            <p class="info_text"><?= $this->cliente->apellidos ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Telefono:</label>
            <p class="info_text"><?= $this->cliente->telefono ?></p>
        </div>
        <div class="info_campo">
            <label class="info_label">Direccion:</label>
            <p class="info_text"><?= $this->cliente->direccion ?></p>
        </div>
    </div>
    <div class="info mb-sm">
        <h3>Productos del pedido</h3>
        <table class="tabla mb-sm">
            <thead>
                <tr>
                    <th class="tabla_cabecera">Producto</th>
                    <th class="tabla_cabecera">Precio</th>
                    <th class="tabla_cabecera">Cantidad</th>
                    <th class="tabla_cabecera">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->detalles as $detalle) { ?>
                    <tr>
                        <td class="tabla_text"><?= $detalle->producto->nombre ?></td>
                        <td class="tabla_text"><?= $detalle->producto->precio ?> €</td>
                        <td class="tabla_text"><?= $detalle->cantidad ?></td>
                        <td class="tabla_text"><?= $detalle->total ?> €</td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="tabla_cabecera tabla_text-right" colspan=3>TOTAL PEDIDO</th>
                    <td class="tabla_text tabla_text-bold"><?= $this->total ?? '' ?> €</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="main-page_nav main-page_nav-flotante">
        <a class="main-page_link" href="<?= $this->url_back ?>">Volver</a>
    </div>
</main>