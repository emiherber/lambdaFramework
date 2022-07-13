<?php

namespace lambdaFramework\web\controllers;

class HomeController extends BaseController {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->vista('home/index');
    }

}
