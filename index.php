<?php
require_once 'mvc/Controllers/Login.php';
include_once 'mvc/Controllers/Homepage.php';
include 'mvc/Controllers/Register.php';
use mvc\Controllers\Login;
use mvc\Controllers\Homepage;
use mvc\Controllers\Register;

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

        $register = new Register();
        $register->register();
        break;
    case '/cinema_management/home':
        if ($method === 'GET') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            } else{
                $home = new Homepage();
                $home->getHomePage();
            }
        }elseif($method === 'POST'){
            $homeController = new Homepage();
            $homeController ->postHomepage();
        }else{
            echo('404 NOT FOUND');
            die();
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
