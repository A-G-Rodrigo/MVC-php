<main class="main-page">
    <h2 class="main-page_titulo">Registro</h2>
    <div>
        <p class="main-page_error"><?= $this->err_msg ?? '' ?></p>
    </div>
    <form class="form" action="" method="POST">
        <div class="form_field">
            <label class="form_label" for="nombre">Nombre</label>
            <input class="form_input" type="text" name="nombre" id="nombre">
            <p class="form_error"><?= $this->errores["nombre"] ?? '' ?></p>
        </div>
        <div class="form_field">
            <label class="form_label" for="email">Correo electrónico</label>
            <input class="form_input" type="text" name="email" id="email">
            <p class="form_error"><?= $this->errores["email"] ?? '' ?></p>
        </div>
        <div class="form_field">
            <label class="form_label" for="password">Contraseña</label>
            <input class="form_input" type="password" name="password" id="password">
            <p class="form_error"><?= $this->errores["password"] ?? '' ?></p>
        </div>
        <div class="form_field">
            <label class="form_label" for="pass2">Repite la contraseña</label>
            <input class="form_input" type="password" name="pass2" id="pass2">
        </div>
        <div class="form_buttons">
            <input class="form_button" type="submit" name="enviar" value="Registrarse">
        </div>
    </form>
</main>