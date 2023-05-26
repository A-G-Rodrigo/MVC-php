<main class="main-page">
    <h2 class="main-page_titulo">Datos del cliente</h2>
    <div>
        <p class="main-page_error"><?= $this->err_msg ?? '' ?></p>
    </div>
    <?php include Config::PATH_BASE . "/views/cliente_form.php" ?>

</main>