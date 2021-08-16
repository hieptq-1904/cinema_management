<?php

namespace mvc\Controllers;
include_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class DeleteMovie
{
    public function getDelMovie(){
        require_once 'mvc/Views/ListMovie.php';
    }
    public function postDelMovie(){
        //var_dump($_POST['btn_delete']);
        $movie_id = $_POST['btn_delete'];
        $db = new DB();
        $data = $db->deleteMovie($movie_id);
        $db->closeDb();
        header('location: listmovie');
        if($data){
            header('location: listmovie');
        }

    }
}