<?php 

namespace App\Controller;

use Framework\Controller\Controller;

class AppController extends Controller {


    protected $viewPath = ROOT . '/src/view/';

    public function __construct()
    {
        $this->template = $this->viewPath . 'template/';
        
    }
}