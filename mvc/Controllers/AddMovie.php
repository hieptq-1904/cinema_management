<?php

namespace mvc\Controllers;
session_start();
require_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class AddMovie
{
    public function getAddMovie(){
        require_once 'mvc/Views/AddMovie.php';
    }
    public function postAddMovie(){
        $db= new DB();
        if($_POST['moviename'] != '' && $_POST['description'] != ''
            && $_POST['time'] != ''&& $_POST['category'] != ''&& $_FILES['image'] != ''){
            if($_POST['time'] <= 0){
                $_SESSION['errors'] = ['Time wrong!'];
                header('location: addmovie');
            }else{
                $movie_name = $_POST['moviename'];
                $description = $_POST['description'];
                $time = $_POST['time'];
                $name_category = $_POST['category'];
                $target_dir = "public/image/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if(isset($_POST["btn_add"])) {
                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check !== false) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                    }
                }
                if ($_FILES["image"]["size"] > 2097152) {
                    header('location: addmovie');
                    $_SESSION['errors'] = ['Sorry, your file is too large!'];
                    $uploadOk = 0;
                }
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    header('location: addmovie');
                    $_SESSION['errors'] = ['Sorry, only JPG, JPEG, PNG & GIF files are allowed!'];
                    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk ) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $data = $db->addMovie($name_category, $movie_name, $description, $_FILES["image"]["name"], $time);
                        if($data){
                            header('location: listmovie');
                            $_SESSION['message'] = ['Add movie successfully!'];
                        }else{
                            header('location: addmovie');
                            $_SESSION['errors'] = ['Add movie unsuccessfully!'];
                        }
                    } else {
                        return false;
                    }
                }else{
                    return false;
                }
            }
            die();

        }else{
            $_SESSION['errors'] = ['Fields must be not empty!'];
            header('location: addmovie');
        }
    }
}