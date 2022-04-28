<?php 

namespace App\Controller;

class UserController extends AppController {


    public function myAccount () 
    {
        if (empty($_SESSION['auth'])) {
            header('Location: /');
        }
        
        $this->render("user/compte");
    }
}