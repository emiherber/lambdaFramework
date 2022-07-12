<?php

namespace database;

use PDO;
use PDOException;

abstract class CfgDB {

    protected PDO $datahost;

    protected function conectar() {
        try {
            $dsn = sprintf('sqlsrv:server=%s;Database=%s', 'sqlserver2017-db,1433','modulohonorario');
            $this->datahost = new PDO($dsn, 'sa', 'Testing!');
            $this->datahost->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException) {
            throw new Exception("No se pudo establecer un enlace con el servidor de base de datos.\n", 50);
        }
    }

}
