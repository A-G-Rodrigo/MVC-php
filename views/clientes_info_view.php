<main class="main-page">
    <h2 class="main-page_titulo">Información del cliente</h2>

    <div class="info mb-sm">
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
        <div class="info_campo">
            <label class="info_label">Correo electrónico:</label>
            <p class="info_text"><?= $this->cliente->email ?></p>
        </div>
    </div>
    <div class="main-page_nav main-page_nav-flotante">
        <a class="main-page_link" href="<?= $this->url_back ?>">Volver</a>
    </div>
</main>