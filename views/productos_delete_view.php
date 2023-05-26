<main class="main-page">
    <h2 class="main-page_titulo">Elimanar Producto</h2>

    <?php include "producto_info.php" ?>

    <div class="main-page_nav">
        <a class="main-page_link" href="<?= $this->url_delete ?>">Eliminar producto definitivamente</a>
    </div>

    <div class="main-page_nav main-page_nav-flotante">
        <a class="main-page_link" href="<?= $this->url_back ?>">Volver</a>
    </div>
</main>