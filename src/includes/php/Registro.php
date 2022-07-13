<?php

namespace lambdaFramework\includes\php;

class Registro {

    private static $intancia;
    private array $registro = [];

    private function __construct() {
        session_start();
        session_regenerate_id();
        $this->registro = &$_SESSION;
    }

    static function getInstance(): array {
        if (self::$intancia == null) {
            self::$intancia = new self();
        }
        return self::$intancia;
    }
    
    /**
     * Retorna si existe en el arreglo un item con esa clave.
     * @param string $name
     * @return bool
     */
    
    function exist(string $name): bool {
        return array_key_exists($name, $this->registro);
    }    
    
    function add(string $name, mixed $item): void {
        $this->registro[$name] = serialize($item);
    }
    
    /**
     * Obtiene el valor guardado en el registro.
     * @param string $name
     * @return mixed
     */
    
    function get(string $name): mixed {
        if(!$this->exist($name)){
            return null;
        }
        return unserialize($this->registro[$name]);
    }
    
    /**
     * Elimina el valor del registro.
     * @param string $name
     * @return void
     */
    
    function remove(string $name): void {
        if ($this->exist($name)){
            unset($this->registro[$name]);
        }
    }

}
