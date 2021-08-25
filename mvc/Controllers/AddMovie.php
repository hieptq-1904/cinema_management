<?php

namespace mvc\Controllers;
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
            && $_POST['category_id'] != ''&& $_FILES['image'] != ''){
            if($_POST['time'] <= 0 ||$_POST['time']>150){
                $_SESSION['errors'] = ['Time wrong!'];
                header('location: addmovie');
            }else{
                $movie_name = $_POST['moviename'];
                $description = $_POST['description'];
                $time = $_POST['time'];
                $id_category = $_POST['category_id'];
                $target_dir = "public/image/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if($check == false) {
                    header('location: addmovie');
                    $_SESSION['errors'] = ['File is not an image'];
                }

                elseif (file_exists($target_file)) {
                    header('location: addmovie');
                    $_SESSION['errors'] =  ['Sorry, file already exists.'];
                }

                elseif ($_FILES["image"]["size"] > 2097152) {
                    header('location: addmovie');
                    $_SESSION['errors'] = ['Sorry, your file is too large!'];

                }
                elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif" ) {
                    header('location: addmovie');
                    $_SESSION['errors'] = ['Sorry, only JPG, JPEG, PNG & GIF files are allowed!'];
                }
                else{
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    $data = $db->addMovie($id_category, $movie_name, $description, $_FILES["image"]["name"], $time);
                    $db->closeDb();
                    if(!$data){
                        header('location: listmovie');
                        $_SESSION['message'] = ['Add movie successfully!'];
                    }
                }
            }
        }else{
            $_SESSION['errors'] = ['Fields must be not empty!'];
            header('location: addmovie');
        }
    }
}