<?php

namespace database;

use PDO;
use PDOException;

class DataBase extends CfgDB {

    private $conexion;
    private $resource;
    private $query;
    private $valores;
    private int $numTransaccion;

    public function setQuery($query): void {
        $this->query = $query;
    }

    public function setValores($valores): void {
        $this->valores = $valores;
    }
    
    private function __construct() {
        $this->conexion = parent::conectar();
        $this->numTransaccion = 0;
    }
    
    public static function getInstance(){
        if(is_null(self::$_singleton)){
            self::$_singleton = new DataBase();
        }
        return self::$_singleton;
    }

}
