<?php

namespace mvc\Controllers;
include_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class DeleteMovie
{
    public function postDelMovie(){
        if(isset($_POST['btn_delete'])){
            $movie_id = $_POST['btn_delete'];
            $db = new DB();
            $db->deleteMovie($movie_id);
            $db->closeDb();
            header('location: listmovie');
        }
    }
}