<?php
namespace mvc\Controllers;

use mvc\Database\DB;

class Register
{

    public function __construct()
    {
    }

    public function getRegister(){
        require_once 'mvc/Views/Register.php';
    }
    public function postRegister(){
        $db = new DB();
        if(isset($_POST['btn_register'])&& $_POST['username'] != ''&& $_POST['password'] != ''
            && $_POST['repassword'] != ''&& $_POST['name'] != ''&& $_POST['address'] != ''&& $_POST['phone'] != ''
            && $_POST['email'] != ''){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            $password = md5($password);
            $repassword = md5($repassword);
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $register = $db->checkRegister($username, $email, $password, $name, $phone, $address);
            $db->closeDb();
            if($password != $repassword){
                $_SESSION['errors'] = ['Password do not match!'];
                header('location: register');
            }elseif($register ){
                header('location: login');
            }else{
                $_SESSION['errors'] = ['Email or username already existed !'];
                header('location: register');
            }
        }
        else{
            $_SESSION['errors'] = ['Fields must be not empty!'];
            header('location: register');
        }
    }
}