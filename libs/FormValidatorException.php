<?php
class FormValidatorException extends Exception {
    private $msgErrores;

    function __construct(String $msg) {
        parent::__construct($msg);
        $this->msgErrores = [];
    }

    function addMessageError(String $key, String $msg) {
        $this->msgErrores[$key] = $msg;
    }

    function getMessagesErrores() {
        return $this->msgErrores;
    }
}
