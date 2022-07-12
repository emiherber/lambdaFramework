<?php
/*
 * servidor de pruebas
 */
define('SERVIDOR_PRUEBAS', true);

/**
 * Habilita el control de autenticación.
 * @access private
 * @var boolean
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