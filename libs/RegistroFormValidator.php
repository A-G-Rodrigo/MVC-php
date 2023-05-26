<?php
class RegistroFormValidatorException extends FormValidatorException {
}
class RegistroFormValidator {
    function __construct(array $data) {
        $this->hayError = false;
        $this->crush = new RegistroFormValidatorException("Hay datos incorrectos.");

        $this->validarNombre($data["nombre"]);
        $this->validarEmail($data["email"]);
        $this->validarPassword($data["password"], $data["pass2"]);

        if ($this->hayError) {
            throw $this->crush;
        }
    }

    private function validarNombre(String $nombre) {
        if ($nombre === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'nombre',
                'El nombre no puede ser vacio.'
            );
        } else if (strlen($nombre) > Config::USUARIO_NOMBRE_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'nombre',
                'El nombre es demasiado largo. Máximo '
                    . Config::USUARIO_NOMBRE_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }

    private function validarEmail(String $email) {
        if ($email === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'email',
                'El nombre no puede ser vacío.'
            );
        } else if (strlen($email) > Config::USUARIO_EMAIL_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'email',
                'El email es demasiado largo. Máximo '
                    . Config::USUARIO_EMAIL_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }
    private function validarPassword(String $pass1, String $pass2) {
        if ($pass1 === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'password',
                'El password no puede ser vacío.'
            );
        } else if (
            strlen($pass1) < Config::USUARIO_PASSWORD_LONGITUD_MINIMA
            || strlen($pass1) > Config::USUARIO_PASSWORD_LONGITUD_MAXIMA
        ) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'password',
                'Longitud del password es incorrecta. Minimo '
                    . Config::USUARIO_PASSWORD_LONGITUD_MINIMA
                    . ' caracteres y máximo '
                    . Config::USUARIO_PASSWORD_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        } else if ($pass1 !== $pass2) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'password',
                'Las contraseñas no coinciden.'
            );
        }
    }
}
