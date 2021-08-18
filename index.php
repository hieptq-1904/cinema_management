<?php
require_once 'mvc/Controllers/Login.php';
include_once 'mvc/Controllers/Homepage.php';
include 'mvc/Controllers/Register.php';
include_once 'mvc/Controllers/ListMovie.php';
include_once 'mvc/Controllers/AddMovie.php';
include_once 'mvc/Controllers/DeleteMovie.php';
include_once 'mvc/Controllers/DetailMovie.php';
use mvc\Controllers\AddMovie;
use mvc\Controllers\ListMovie;
use mvc\Controllers\Login;
use mvc\Controllers\Homepage;
use mvc\Controllers\Register;
use mvc\Controllers\DeleteMovie;
use mvc\Controllers\DetailMovie;

$method = $_SERVER['REQUEST_METHOD'];

$url = parse_url($_SERVER['REQUEST_URI']);
parse_str($url['query'], $params);

    switch ($url['path']){
    case '/cinema_management/login'  :
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
        if($method === 'GET'){
            $register = new Register();
            $register->getRegister();
        }elseif ($method === 'POST'){
            $registerController = new Register();
            $registerController->postRegister();
        }else{
            echo('404 NOT FOUND');
            die();
        }
        break;

    case '/cinema_management/home':
        if ($method === 'GET') {
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            } else{
                $home = new Homepage();
                $home->getHomePage();
            }
        }else{
            echo('404 NOT FOUND');
            die();
        }
        break;
    case '/cinema_management/':
        header('location: home');
        break;
    case '/cinema_management/listmovie':
        if($method === 'GET'){
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            } else{
                $list = new ListMovie();
                $list->getListMovie();
            }
        }
        else{
            echo('404 NOT FOUND');
            die();
        }
        break;
    case '/cinema_management/addmovie':
        if($method === 'GET'){
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            } else{
                $add = new AddMovie();
                $add->getAddMovie();
            }
        }elseif($method === 'POST'){
            $addMovie = new AddMovie();
            $addMovie ->postAddMovie();
        } else{
            echo('404 NOT FOUND');
            die();
        }
        break;
    case '/cinema_management/deletemovie':
        if (!isset($_SESSION['user_id'])) {
            header('Location: login');
        }
        if ($method === 'POST'){
                $deleteMovie = new DeleteMovie();
                $deleteMovie ->postDelMovie();
        }else{
            echo('404 NOT FOUND');
            die();
        }
        break;
    case '/cinema_management/detailmovie':
        if ($method === 'GET'){
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            }elseif (!isset($params['id'])){
                return false;
            }else{
                $detailMovie = new DetailMovie();
                $detailMovie ->getDetailMovie($params['id']);
            }
        }else{
            echo('404 NOT FOUND');
            die();
        }
        break;
    default:
        if (substr($_SERVER['REQUEST_URI'], 0, 7) !== '/public'){
            echo('404 NOT FOUND');
            die();
        }
        break;
}
