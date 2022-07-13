<?php

namespace lambdaFramework\includes\php\database;

use PDO;
use PDOException;

abstract class CfgDB {

    protected string $usuario = '';
    protected string $clave = '';
    protected string $host = '';
    protected int $puerto = 0;
    protected string $dataBase = '';
    protected PDO $datahost;

    protected function conectar() {
        try {
            $dsn = sprintf('sqlsrv:server=%s;Database=%s',
                    $this->host . ',' . $this->puerto,
                    $this->dataBase
            );
            $this->datahost = new PDO($dsn, $this->usuario, $this->clave);
            $this->datahost->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException) {
            throw new Exception("No se pudo establecer un enlace con el servidor de base de datos.\n", 50);
        }
    }

    protected function desconectar() {
        $this->datahost = null;
    }

}
