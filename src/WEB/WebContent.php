<?php

namespace LambdaFramework\WEB;
use stdClass;
use Exception;

/**
 * Procesa las solicitudes y las transforma para que puedan ser procesadas por los controladores.
 */
class WebContent {

    /**
     * Lista los contraladores no permitidos para llamar por url.
     * @access private
     * @var array string
     */
    private $controladoresExcluidos = ['Base'];
    private string $namespaceController = 'LambdaFramework\WEB\controllers\\';

    /**
     * Lista los contraladores publicos en caso que la autenticación este habilitada.
     * @access private
     * @var array string
     */
    private $controladoresPublicos = ['Login'];

    private string $controlador;
    private string $accion;
    private $args;

    function __construct() {
        $urlTmp = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);
        $arrayUrlTmp = array_filter(explode('/', $urlTmp));
        $this->controlador = ucfirst(htmlspecialchars(array_shift($arrayUrlTmp), ENT_QUOTES, 'UTF-8'));
        $this->accion = strtolower(htmlspecialchars(array_shift($arrayUrlTmp), ENT_QUOTES, 'UTF-8'));
        $this->args = [];

        foreach ($arrayUrlTmp as $item) {
            $this->args[] = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
        }

        unset($urlTmp);
        unset($arrayUrlTmp);
        $this->defaults();
    }

    /**
     * Define los controladores y acciones por defecto en caso que la REQUEST_URI venga vacía.
     * @return void
     */
    private function defaults(): void {
        if ($this->controlador == '' || !isset($this->controlador)) {
            $this->controlador = 'Home';
        }

        if ($this->accion == '' || !isset($this->accion)) {
            $this->accion = 'index';
        }

        if (HABILITA_AUTENTICACION && !in_array($this->controlador, $this->controladoresPublicos)) {
            $this->controlador = 'Login';
            $this->accion = 'index';
        }
    }

    private function validarRequest(): bool {
        $claseControlador = $this->namespaceController . $this->controlador . 'Controller';
        
        if (array_key_exists($this->controlador, $this->controladoresExcluidos)) {
            return false;
        }
        
        if (!class_exists($claseControlador)) {
            return false;
        }

        if (!is_callable(array(new $claseControlador, $this->accion))) {
            return false;
        }

        return true;
    }

    function render(): void {
        $view = new stdClass();
        $view->headTitulo = '';
        $view->titulo = '';
        $view->buffer = '';
        $layout = 'layout.php';
        $vista = '';
        try {
            if (!$this->validarRequest()) {
                throw new Exception('No se pudo encontrar el recurso solicitado.', 404);
            }

            $claseController = $this->namespaceController . $this->controlador . 'Controller';
            $instanciaController = new $claseController;
            $metodoController = $this->accion;

            if (count($this->args) == 0) {
                $instanciaController->$metodoController();
            } else {
                call_user_func_array(array($instanciaController, $metodoController), $this->args);
            }
            
            $view->headTitulo = $instanciaController->getHeadTitulo();
            $view->titulo = $instanciaController->getTitulo();
            $view->scripts = $instanciaController->getScript();
            $vista = $instanciaController->getVista();
            
            $layout = $instanciaController->getLayout() . '.php';
        } catch (Exception $e) {
            $layout = 'layout_error.php';
            $vista = '/vista/common/error';
            
            switch ($e->getCode()) {
                case 401:
                case 403:
                    $view->headTitulo = 'Error ' . $e->getCode();
                    $view->titulo = 'Error '. $e->getCode(). ' - No tiene suficientes permisos.';
                    $view->msjError = $e->getMessage();
                    break;
                case 404:
                    $view->headTitulo = 'Error 404';
                    $view->titulo = 'Error 404 - Página no encontrada.';
                    $view->msjError = $e->getMessage();
                    break;
                case 500:
                    $view->headTitulo = 'Error 500';
                    $view->titulo = 'Error 500 - Error interno controlado';
                    $view->msjError = $e->getMessage();
                    $view->codeError = 500;
                    break;
                default:
                    $view->headTitulo = 'Error 500';
                    $view->titulo = 'Error 500 - Error no controlado por el sistema.';
                    $view->msjError = $e->getMessage();
                    break;
            }
        }

        if($vista == ''){
            exit();
        }
        
        ob_start();
        require_once __DIR__ . $vista . '.php';
        $view->buffer = ob_get_contents();
        ob_end_clean();
        
        if ($layout != '') {
           include __DIR__ . '/vista/common/' . $layout;
        }
    }

}
