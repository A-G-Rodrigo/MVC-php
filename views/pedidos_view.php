<main class="main-page">
    <h2 class="main-page_titulo">Pedidos</h2>

    <?php if (empty($this->pedidos)) {
        echo '<div class="center">No hay pedidos pendientes</div>';
    } else { ?>
        <table class="tabla">
            <thead>
                <tr>
                    <th class="tabla_cabecera">#</th>
                    <th class="tabla_cabecera">Fecha de compra</th>
                    <th class="tabla_cabecera">Estado</th>
                    <th class="tabla_cabecera">Fecha de entrega</th>
                    <th class="tabla_cabecera">Cliente</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->pedidos as $item) { ?>
                    <tr>
                        <td class="tabla_text">
                            <a href="<?= Config::URL_BASE . "/pedidos/info/" . $item->id ?>"><?= $item->id ?></a>
                        </td>
                        <td class="tabla_text"><?= $item->fechaCompra ?></td>
                        <td class="tabla_text"><?= $item->estado ?></td>
                        <td class="tabla_text"><?= $item->fechaEntrega ?></td>
                        <td class="tabla_text">
                            <a href="<?= Config::URL_BASE . "/clientes/info/" . $item->idCliente ?>"><?= $item->idCliente ?></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
</main>