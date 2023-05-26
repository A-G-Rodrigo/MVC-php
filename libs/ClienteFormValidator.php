<?php
class ClienteFormValidatorException extends FormValidatorException {
}

class ClienteFormValidator {
    function __construct(array $data) {
        $this->crush = new ClienteFormValidatorException('Datos Incorrectos.');
        $this->hayError = false;

        $this->validarNombre($data["nombre"]);
        $this->validarApellidos($data["apellidos"]);
        $this->validarDireccion($data["direccion"]);
        $this->validarTelefono($data["telefono"]);
        $this->validarEmail($data["email"]);

        if ($this->hayError) {
            throw $this->crush;
        }
    }

    private function validarNombre(String $nombre) {
        if (strlen($nombre) === 0) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'nombre',
                'El nombre no puede ser vacio.'
            );
        } else if (strlen($nombre) > Config::CLIENTE_NOMBRE_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'nombre',
                'El nombre es demasiado largo. Máximo '
                    . Config::CLIENTE_NOMBRE_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }
    private function validarApellidos(String $apellidos) {
        if (strlen($apellidos) === 0) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'apellidos',
                'Los apellidos no pueden ser vacios.'
            );
        } else if (strlen($apellidos) > Config::CLIENTE_APELLIDOS_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'apellidos',
                'Demasiado largo. Máximo '
                    . Config::CLIENTE_APELLIDOS_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }

    private function validarDireccion(String $direccion) {
        if ($direccion === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'direccion',
                'No puede ser vacío.'
            );
        } else if (strlen($direccion) > Config::CLIENTE_DIRECCION_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'direccion',
                'Demasiado larga. Máximo '
                    . Config::CLIENTE_DIRECCION_LONGITUD_MAXIMA . ' caracteres.'
            );
        }
    }

    private function validarTelefono(String $telefono) {
        if ($telefono === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'telefono',
                'No puede ser vacío.'
            );
        } else if (strlen($telefono) !== Config::CLIENTE_TELEFONO_LONGITUD) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'telefono',
                'No válido. Se esperan '
                    . Config::CLIENTE_TELEFONO_LONGITUD . ' digitos.'
            );
        }
    }

    private function validarEmail(String $email) {
        if ($email === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'email',
                'No puede ser vacío.'
            );
        } else if (strlen($email) > Config::CLIENTE_EMAIL_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'email',
                'Demasiado largo. Máximo '
                    . Config::CLIENTE_EMAIL_LONGITUD_MAXIMA . ' caracteres.'
            );
        }
    }

    public function isOK() {
        return !$this->hayError;
    }
}
