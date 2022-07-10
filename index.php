<?php
use LambdaFramework\WEB;
require_once 'vendor/autoload.php';
require_once 'src/includes/php/config.php';

$contenido = new WEB\WebContent();
$contenido->render();