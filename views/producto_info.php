<div class="info">
    <div class="info_campo">
        <label class="info_label">Nombre:</label>
        <p class="info_text"><?= $this->producto->nombre ?></p>
    </div>
    <div class="info_campo">
        <label class="info_label">Stock:</label>
        <p class="info_text"><?= $this->producto->stock ?></p>
    </div>
    <div class="info_campo">
        <label class="info_label">Marca:</label>
        <p class="info_text"><?= $this->producto->marca ?></p>
    </div>
    <div class="info_campo">
        <label class="info_label">Precio:</label>
        <p class="info_text"><?= $this->producto->precio ?> €</p>
    </div>
    <div class="info_campo">
        <label class="info_label">Descripción:</label>
        <p class="info_text"><?= $this->producto->descripcion ?></p>
    </div>
    <div class="info_campo">
        <label class="info_label">Categoria:</label>
        <p class="info_text"><?= $this->producto->categoria ?></p>
    </div>
    <div class="info_campo">
        <label class="info_label">Peso:</label>
        <p class="info_text"><?= $this->producto->peso ?> Kg.</p>
    </div>
</div>