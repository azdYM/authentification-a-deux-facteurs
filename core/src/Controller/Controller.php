<?php

namespace Framework\Controller;

use App;

class Controller 
{
    protected $viewPath;
    protected $template;

    public function render($view, $variables=[]) {
        
        extract($variables);
        
        //si on est connecté on definit la variable $auth
        if (!empty($_SESSION['auth'])) {
        
            $key = key($_SESSION['auth']);
            $auth = App::getInstance()
                ->getRepository($key)
                ->find($_SESSION['auth'][$key])
            ;
        }

        ob_start();
        require($this->template . $view . '.php');
        $content = ob_get_clean();

        require($this->viewPath . 'index.php');
    }
}