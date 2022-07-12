<?php
namespace LambdaFramework\WEB\controllers;
use stdClass;

abstract class BaseController {
    
    function __construct(
        protected string $titulo = '',
        protected string $script = '',
        private string $vista = '',
        protected string $headTitulo = 'Framework - Lambda SI',
        protected string $layout = 'layout'
    ) {}
    
    public function getHeadTitulo(): string {
        return $this->headTitulo;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getLayout(): string {
        return $this->layout;
    }

    public function getVista(): string {
        return $this->vista;
    }

    public function getScript(): string {
        return $this->script;
    }
    
    protected function vista(string $archivo, Array $datos = []): void {
        $this->vista = '/vista/'.$archivo;
        $view = new stdClass();
        
        foreach ($datos as $key => $value) {
            $view->$key=$value;
        }
    }
}
