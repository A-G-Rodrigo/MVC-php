<form class="form" action="" method="post" enctype="multipart/form-data">
    <div class="form_field">
        <label class="form_label" for="nombre">Nombre</label>
        <input class="form_input" type="text" name="nombre" id="nombre" value="<?= $_POST['nombre'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["nombre"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="stock">Stock</label>
        <input class="form_input" type="text" name="stock" id="stock" value="<?= $_POST['stock'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["stock"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="marca">Marca</label>
        <input class="form_input" type="text" name="marca" id="marca" value="<?= $_POST['marca'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["marca"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="precio">Precio</label>
        <input class="form_input" type="text" name="precio" id="precio" value="<?= $_POST['precio'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["precio"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="descipcion">Descripcion</label>
        <textarea class="form_textarea" name="descripcion" id="descripcion"><?= $_POST['descripcion'] ?? '' ?></textarea>
        <p class="form_error"><?= $this->errores["descripcion"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="categoria">Categoria</label>
        <input class="form_input" type="text" name="categoria" id="categoria" value="<?= $_POST['categoria'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["categoria"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="peso">Peso</label>
        <input class="form_input" type="text" name="peso" id="peso" value="<?= $_POST['peso'] ?? '' ?>">
        <p class="form_error"><?= $this->errores["peso"] ?? '' ?></p>
    </div>
    <div class="form_field">
        <label class="form_label" for="imagen">Selecciona una imagen para el producto</label>
        <input class="form_input" type="file" name="imagen" id="imagen">
        <p class="form_error"><?= $this->errores["imagen"] ?? '' ?></p>
    </div>
    <div class="form_buttons">
        <input class="form_button" type="submit" name="enviar" value="Enviar">
    </div>
</form>