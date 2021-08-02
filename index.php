<?php

switch ($_SERVER['REQUEST_URI']){
    case '/cinema_management/login':
        include 'mvc/Controllers/Login.php';
        $loginController = new Login();
        $loginController ->login();
        break;
    case '/cinema_management/register':
        include 'mvc/Controllers/Register.php';
        $homeController = new Register();
        $homeController->register();
        break;
    case '/cinema_management/':
        include 'mvc/Controllers/Homepage.php';
        $homeController = new Homepage();
        $homeController->home();
        break;
    default:
        if (substr($_SERVER['REQUEST_URI'], 0, 7) !== '/public'){
            echo('404 NOT FOUND');
            die();
        }
        break;

}
