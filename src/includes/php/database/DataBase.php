<?php

namespace lambdaFramework\includes\php\database;

use PDO;
use PDOException;

class DataBase extends CfgDB {

    private $conexion;
    private $query;
    private $valores;
    private int $numTransaccion;

    public function setQuery($query): void {
        $this->query = $query;
    }

    public function setValores($valores): void {
        $this->valores = $valores;
    }

    function __construct() {
        $this->conexion = parent::conectar();
        $this->numTransaccion = 0;
        $this->query = '';
    }

    function __destruct() {
        $this->desconectar();
    }

    /**
     * Ejecutar Querys de insert, update y delete.
     * @return bool
     * @throws Exception
     */
    function ejecutar(): bool {
        $campos = [];
        $statement = $this->conexion->prepare($this->query);

        if ($statement == false) {
            return false;
        }

        if (preg_match_all("/(:\w+)/", $this->query, $campos, PREG_PATTERN_ORDER)) { //tomo los nombres de los campos iniciados con :xxxxx
            foreach ($campos as $parametro) {
                $statement->bindValue($parametro, $this->valores[substr($parametro, 1)]);
            }
        }

        try {
            if (!$statement->execute()) {
                return false;
            }
            $statement->closeCursor();
            return true;
        } catch (PDOException $e) {
            $mensaje = "Error de ejecuci&oacute;n en la consulta SQL. <br>";
            $mensaje .= $e->getMessage() . '<br><br>';
            if (SERVIDOR_PRUEBAS) {
                ob_start();
                $statement->debugDumpParams();
                $mensaje .= ob_get_contents() . '<br>';
                ob_end_clean();
            }
            throw new Exception($mensaje, 500);
        }
        return false;
    }

    /**
     * Funcion para select de multiples filas.
     * @return bool|array
     * @throws Exception
     */
    function consultar(): bool|array {
        $campos = [];
        $statement = $this->conexion->prepare($this->query);
        if ($statement == false) {
            return false;
        }

        if (preg_match_all("/(:\w+)/", $this->query, $campos, PREG_PATTERN_ORDER)) { //tomo los nombres de los campos iniciados con :xxxxx
            foreach ($campos as $parametro) {
                $statement->bindValue($parametro, $this->valores[substr($parametro, 1)]);
            }
        }
        try {
            if (!$statement->execute()) {
                return false;
            }
            
            $result = $statement->fetchAll(PDO::FETCH_OBJ); //si es una consulta que devuelve valores los guarda en un arreglo.
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            $mensaje = "Error de ejecuci&oacute;n en la consulta SQL. <br>";
            $mensaje .= $e->getMessage() . '<br><br>';
            if (SERVIDOR_PRUEBAS) {
                ob_start();
                $statement->debugDumpParams();
                $mensaje .= ob_get_contents() . '<br>';
                ob_end_clean();
            }

            throw new Exception($mensaje, 500);
        }
        return false;
    }
    
    /**
     * Funcion para consultas que devuelven un solo objeto.
     * @return bool|array
     * @throws Exception
     */
    function cargarObjeto(): bool | array {
        $campos = [];
        $statement = $this->conexion->prepare($this->query);

        if ($statement == false) {
            return false;
        }

        if (preg_match_all("/(:\w+)/", $this->query, $campos, PREG_PATTERN_ORDER)) { //tomo los nombres de los campos iniciados con :xxxxx
            foreach ($campos as $parametro) {
                $statement->bindValue($parametro, $this->valores[substr($parametro, 1)]);
            }
        }
        try {
            if (!$statement->execute()) { //si no se ejecuta la consulta...
                return false;
            }
            
            $resultado = $statement->fetch(PDO::FETCH_OBJ); //si es una consulta que devuelve valores los guarda en un arreglo.
            $statement->closeCursor();
            return $resultado;
        } catch (PDOException $e) {
            $mensaje = "Error de ejecuci&oacute;n en la consulta SQL. No se pudo cargar el Objeto <br>";
            $mensaje .= $e->getMessage() . '<br><br>';
            ob_start();
            $statement->debugDumpParams();
            $mensaje .= ob_get_contents() . '<br>';
            ob_end_clean();

            throw new Exception($mensaje, 500);
        }
        return false;
    }

}
