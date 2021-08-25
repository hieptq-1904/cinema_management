<?php

namespace mvc\Controllers;
include_once 'mvc/Database/DB.php';

use mvc\Database\DB;

class UpdateMovie
{
    public function getUpdateMovie($id){
        $db= new DB();
        $data = $db->detailMovie($id);
        require_once 'mvc/Views/UpdateMovie.php';
    }
    public function postUpdateMovie($id){
        $db = new DB();

        if($_POST['moviename'] != '' || $_POST['description']!='' || $_POST['category_id']!=''
            || $_POST['time'] != ''){
            if($_POST['time'] <= 0 || $_POST['time'] >150){
                $_SESSION['errors'] = ['Time wrong!'];
                header('location: editmovie');
            }else{
                $movie_name = $_POST['moviename'];
                $description = $_POST['description'];
                $time = $_POST['time'];
                $id_category = $_POST['category_id'];
                if ($_FILES['image']['name'] != '') {
                    $target_dir = "public/image/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["image"]["tmp_name"]);
                    if($check == false) {
                        header('location: editmovie');
                        $_SESSION['errors'] = ['File is not an image'];
                    }

                    elseif ($_FILES["image"]["size"] > 2097152) {
                        header('location: editmovie');
                        $_SESSION['errors'] = ['Sorry, your file is too large!'];

                    }
                    elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif" ) {
                        header('location: editmovie');
                        $_SESSION['errors'] = ['Sorry, only JPG, JPEG, PNG & GIF files are allowed!'];
                    }
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                }
                $datamovie = $db->updateMovie($id,$id_category, $movie_name, $description,$_FILES['image']['name'], $time);
                $db->closeDb();
                if($datamovie){
                    header('location: listmovie');
                    $_SESSION['message'] = ['Update movie successfully!'];
                }
            }
        }else{
            $_SESSION['errors'] = ['Fields must be not empty!'];
            header('location: editmovie');
        }
    }
}
