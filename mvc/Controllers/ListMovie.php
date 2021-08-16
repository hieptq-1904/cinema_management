<?php
namespace mvc\Controllers;
include_once 'mvc/Database/DB.php';
use mvc\Database\DB;

class ListMovie
{
    public function getListMovie(){
        require_once 'mvc/Views/ListMovie.php';
    }


}