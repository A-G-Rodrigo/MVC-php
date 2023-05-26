<?php
class ProductoFormValidatorException extends FormValidatorException {
}

class ProductoFormValidator {
    function __construct(array $data) {
        $this->crush = new ProductoFormValidatorException('Datos Incorrectos.');
        $this->hayError = false;

        $this->validarNombre($data["nombre"]);
        $this->validarStock($data["stock"]);
        $this->validarMarca($data["marca"]);
        $this->validarPrecio($data["precio"]);
        $this->validarCategoria($data["categoria"]);
        $this->validarPeso($data["peso"]);

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
        } else if (strlen($nombre) > Config::MARCA_Y_NOMBRE_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'nombre',
                'El nombre es demasiado largo. Máximo '
                    . Config::MARCA_Y_NOMBRE_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }
    private function validarMarca(String $marca) {
        if (strlen($marca) === 0) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'marca',
                'La marca no puede ser vacio.'
            );
        } else if (strlen($marca) > Config::MARCA_Y_NOMBRE_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'marca',
                'La marca es demasiado largo. Máximo '
                    . Config::MARCA_Y_NOMBRE_LONGITUD_MAXIMA
                    . ' caracteres.'
            );
        }
    }

    private function validarStock(string $stock) {
        if (!is_numeric($stock)) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'stock',
                'El stock debe ser un número entre '
                    . Config::STOCK_MINIMO . ' y '
                    . Config::STOCK_MAXIMO . '.'
            );
        } else if ($stock < Config::STOCK_MINIMO || $stock > Config::STOCK_MAXIMO) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'stock',
                'El stock debe estar entre '
                    . Config::STOCK_MINIMO . ' y '
                    . Config::STOCK_MAXIMO . '.'
            );
        }
    }

    private function validarPrecio(string $precio) {
        if (!is_numeric($precio)) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'precio',
                'El precio debe ser un número entre '
                    . Config::PRECIO_MINIMO . ' y '
                    . Config::PRECIO_MAXIMO
            );
        } else if ($precio < Config::PRECIO_MINIMO || $precio > Config::PRECIO_MAXIMO) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'precio',
                'El precio debe estar  '
                    . Config::PRECIO_MINIMO . ' y '
                    . Config::PRECIO_MAXIMO
            );
        }
    }

    private function validarCategoria(String $categoria) {
        if ($categoria === '') {
            $this->hayError = true;
            $this->crush->addMessageError(
                'categoria',
                'La categoria no puede ser vacía.'
            );
        } else if (strlen($categoria) > Config::CATEGORIA_LONGITUD_MAXIMA) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'categoria',
                'La categoría es demasiado larga. Máximo '
                    . Config::CATEGORIA_LONGITUD_MAXIMA . ' caracteres.'
            );
        }
    }

    private function validarPeso(string $peso) {
        if (!is_numeric($peso)) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'peso',
                'El peso debe ser un número entre '
                    . Config::PESO_MINIMO . ' y '
                    . Config::PESO_MAXIMO
            );
        } else if ($peso < Config::PESO_MINIMO || $peso > Config::PESO_MAXIMO) {
            $this->hayError = true;
            $this->crush->addMessageError(
                'peso',
                'El peso debe estar  '
                    . Config::PESO_MINIMO . ' y '
                    . Config::PESO_MAXIMO
            );
        }
    }

    public function isOK() {
        return !$this->hayError;
    }
}
