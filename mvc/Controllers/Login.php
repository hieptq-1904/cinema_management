<?php

namespace mvc\Controllers;
session_start();
include_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class Login
{
    public function __construct()
    {
    }

    public function getLoginView()
    {
        require_once 'mvc/Views/Login.php';
    }

    public function postLogin()
    {
        $db = new DB();
        if(isset($_POST['btn_login']) && $_POST['username']!= ' ' && $_POST['password'] != ' '){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = md5($password);
            $user = $db->checkLogin($username, $password);
            $db->closeDb();
            if($user){
                $_SESSION['user_id'] = [$user];
                header('location: home');
            }else{
                $_SESSION['errors'] = ["Incorrect account!"];
                header('location: login');
            }
        }if(isset($_POST['btn_login']) || $_POST['username'] == ' ' || $_POST['password'] == ' '){
            $_SESSION['errors'] = ['Username or password cannot be empty!'];
            header('location: login');
        }
    }
}
