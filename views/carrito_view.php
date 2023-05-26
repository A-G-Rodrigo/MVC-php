<main class="main-page">
    <h2 class="main-page_titulo">Carrito</h2>

    <?php if (empty($this->carrito)) {
        echo '<div class="center">El carrito está vacío</div>';
    } else { ?>
        <table class="tabla">
            <thead>
                <tr>
                    <th class="tabla_cabecera">Producto</th>
                    <th class="tabla_cabecera">Precio</th>
                    <th class="tabla_cabecera">Cantidad</th>
                    <th class="tabla_cabecera">Total</th>
                    <th class="tabla_cabecera"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->carrito as $prod) { ?>
                    <tr>
                        <td class="tabla_text"><?= $prod["nombre"] ?></td>
                        <td class="tabla_text"><?= $prod["precio"] ?> €</td>
                        <td class="tabla_text"><?= $prod["cantidad"] ?></td>
                        <td class="tabla_text"><?= $prod["total"] ?> €</td>
                        <td class="tabla_text"><a href="<?= Config::URL_BASE . "/carrito/quitar/" . $prod["id"] ?>">Quitar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="tabla_cabecera tabla_text-right" colspan=3>TOTAL COMPRA</th>
                    <td class="tabla_text tabla_text-bold"><?= $this->total ?> €</td>
                    <td class="tabla_text"></td>
                </tr>
            </tfoot>
        </table>
    <?php } ?>
    <div class="main-page_nav main-page_nav-flotante <?= $this->classComprarLink ?>">
        <a class="main-page_link" href="<?= Config::URL_BASE . "/carrito/comprar" ?>">Comprar</a>
    </div>
</main>