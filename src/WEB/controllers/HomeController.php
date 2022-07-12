<?php

namespace LambdaFramework\WEB\controllers;

class HomeController extends BaseController {

    function __construct() {
        parent::__construct();
    }

    function index() {
        throw new \Exception('prueba error log', 404);
        $this->vista('home/index');
    }

}
