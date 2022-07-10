<?php

namespace LambdaFramework\WEB\controllers;
use Exception;

class HomeController extends BaseController{
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        throw new Exception('home/index', 401);
        $this->vista('home/index');
    }
}
