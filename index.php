<?php
require_once 'mvc/Controllers/Login.php';
include_once 'mvc/Controllers/Homepage.php';
include_once 'mvc/Controllers/Register.php';
include_once 'mvc/Controllers/ListMovie.php';
include_once 'mvc/Controllers/AddMovie.php';
include_once 'mvc/Controllers/DeleteMovie.php';
include_once 'mvc/Controllers/DetailMovie.php';
include_once 'mvc/Controllers/UpdateMovie.php';
include_once 'mvc/Controllers/MovieSchedule.php';
include_once 'mvc/Controllers/SetMovieSchedule.php';
use mvc\Controllers\AddMovie;
use mvc\Controllers\ListMovie;
use mvc\Controllers\Login;
use mvc\Controllers\Homepage;
use mvc\Controllers\Register;
use mvc\Controllers\DeleteMovie;
use mvc\Controllers\DetailMovie;
use mvc\Controllers\UpdateMovie;
use mvc\Controllers\MovieSchedule;
use mvc\Controllers\SetMovieSchedule;

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
    case '/cinema_management/logout':
        if($method === 'GET'){
            if (!isset($_SESSION['user_id'])) {
                header('Location: login');
            }else{
                unset($_SESSION['user_id']);
                session_destroy();
                header('location: login');
            }
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
            }else{
                if (!isset($params['id'])){
                    echo('404 NOT FOUND');
                    die();
                }else{
                    $detailMovie = new DetailMovie();
                    $detailMovie ->getDetailMovie($params['id']);
                }
            }
        }else{
            echo('404 NOT FOUND');
            die();
        }
        break;
        case '/cinema_management/editmovie':
            if ($method === 'GET'){
                if (!isset($_SESSION['user_id'])) {
                    header('Location: login');
                }elseif (!isset($params['id'])){
                    header('location:listmovie');
                    $_SESSION['errors'] = ['Id wrong'];
                }else{
                    $updateMovie = new UpdateMovie();
                    $updateMovie ->getUpdateMovie($params['id']);
                }
            }elseif ($method === 'POST'){
                if (!isset($_SESSION['user_id'])) {
                    header('Location: login');
                }elseif (!isset($params['id'])){
                    echo '404 NOT FOUND';
                    die();
                }else{
                    $update = new UpdateMovie();
                    $update ->postUpdateMovie($params['id']);
                }
            }else{
                echo('404 NOT FOUND');
                die();
            }
            break;
        case '/cinema_management/movieschedule':
            if($method === 'GET'){
                if (!isset($_SESSION['user_id'])) {
                    header('Location: login');
                } else{
                    $list = new MovieSchedule();
                    $list->getMovieSchedule();
                }
            }
            else{
                echo('404 NOT FOUND');
                die();
            }
            break;
        case '/cinema_management/setmovieschedule':
            if($method === 'GET'){
                if (!isset($_SESSION['user_id'])) {
                    header('Location: login');
                } else{
                    $setmovie = new SetMovieSchedule();
                    $setmovie->getSetMovieSchedule();
                }
            }elseif($method === 'POST'){
                $setMovieSchedule = new SetMovieSchedule();
                $setMovieSchedule ->postSetMovieSchedule();
            } else{
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
