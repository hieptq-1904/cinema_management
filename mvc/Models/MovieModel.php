<?php
namespace mvc\Models;
use mvc\Models\Users;

class Movies{
    public $id;
    public $movie_name;
    public $description;
    public $image;
    public $time;
    public $user_id;
    public Users $user;

    public function __construct($id, $movie_name, $description, $image,$time, $user_id){
        $this->id = $id;
        $this->movie_name = $movie_name;
        $this->description = $description;
        $this->image = $image;
        $this->time = $time;
        $this->user_id= $user_id;
    }


}
