<?php

namespace LambdaFramework\WEB\controllers;

class HomeController extends BaseController{
    function __construct() {
        parent::__construct();
    }
    
    function index(){
        $this->vista('home/index');
    }
}
