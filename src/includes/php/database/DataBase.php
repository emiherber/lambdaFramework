<?php

namespace lambdaFramework\includes\php\database;

/**
 * Se elige que controlador se va a utilizar.
 */
class DataBase extends MSSQLControlador{

    function __construct() {
        $this->usuario = '';
        $this->clave = '';
        $this->dataBase = '';
        $this->host = '';
        $this->puerto = 0;
        $this->query = '';
        $this->valores = [];
        parent::conectar();
    }

    function __destruct() {
        $this->desconectar();
    }
}
