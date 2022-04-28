<?php

namespace App\Controller;

use App;
use App\Controller\AppController;

class HomeController extends AppController {

    public function index() {
        $this->render("index");
    }
}