<?php

define('ROOT', dirname(__DIR__)); 
require ROOT . '/src/App.php';

$app = App::getInstance();
$app->load();

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/') {

    $controller = new App\Controller\HomeController();
    $controller->index();

} else if ($uri === '/login') {

    $controller = new App\Controller\SecurityController();
    $controller->login();

} else if ($uri === '/logout') {
    
    $controller = new App\Controller\SecurityController();
    $controller->logout();

}else if ($uri === '/active-totp') {

    $controller = new App\Controller\SecurityController();
    $controller->activeTotp($_SESSION['auth']);

}else if ($uri === '/remove-totp') {

    $controller = new App\Controller\SecurityController();
    $controller->removeTotp($_SESSION['auth']);

}else if ($uri === '/login-totp') {

    $controller = new App\Controller\SecurityController();
    $controller->loginTotp();

} else if ($uri === '/account') {

    $controller = new App\Controller\UserController();
    $controller->myAccount();

}else if ($uri === '/register') {

    $controller = new App\Controller\SecurityController();
    $controller->register();
}