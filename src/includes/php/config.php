<?php
/*
 * servidor de pruebas
 */
define('SERVIDOR_PRUEBAS', true);

/**
 * Habilita el control de autenticación.
 */
define('HABILITA_AUTENTICACION', false);

/*
 * zona horaria
 */
date_default_timezone_set('America/Argentina/Buenos_Aires');

if(PHP_OS == 'WINNT'){
    setlocale(LC_ALL, 'esp');
    define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/');
}else{
    setlocale(LC_ALL, 'es_AR.UTF-8');
    define('__DR__', $_SERVER['DOCUMENT_ROOT'].'/');
}

/*
 * Dominio del servidor
 */
$auxServer = isset($_SERVER["HTTPS"]) ? 'https' : 'http';
define("__PATHURL__",  $auxServer."://".$_SERVER["HTTP_HOST"]."/");

/**
 * Creamos la sesion
 */
\lambdaFramework\includes\php\Registro::getInstance();