<?php

namespace mvc\Controllers;

require_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class DetailMovie
{
    public function getDetailMovie($id){
        $db = new DB();
        $data = $db->detailMovie($id);
        if($data){
            require_once 'mvc/Views/DetailMovie.php';
        }else{
            echo '404 NOT FOUND';
            die();
        }
    }
}