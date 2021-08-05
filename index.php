<?php
require_once 'mvc/Controllers/Login.php';
include_once 'mvc/Controllers/Homepage.php';
use mvc\Controllers\Login;

session_start();
$method = $_SERVER['REQUEST_METHOD'];

    switch ($_SERVER['REQUEST_URI']){
    case '/cinema_management/login':

        if ($method === 'GET') {

            if (isset($_SESSION['user_id'])) {
                header('Location: home');
            } else {
                $login = new Login();
                $login->getLoginView();
            }
        } elseif ($method === 'POST') {
            $loginController = new Login();
            $loginController->postLogin();
        } else {
            echo('404 NOT FOUND');
            die();
        }

        break;
    case '/cinema_management/register':
        include 'mvc/Controllers/Register.php';
        $homeController = new Register();
        $homeController->register();
        break;
    case '/cinema_management/home':
        if ($method === 'GET') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            } else{
                require_once 'mvc/Controllers/Homepage.php';
                $home = new Homepage();
                $home->getHomePage();
            }
        }
        break;
    case '/cinema_management/':
        header('location: home');
        break;

    default:
        if (substr($_SERVER['REQUEST_URI'], 0, 7) !== '/public'){
            echo('404 NOT FOUND');
            die();
        }
        break;
}
