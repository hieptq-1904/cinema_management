<?php
namespace mvc\Models;
use mvc\Models\User;

class Movie{
    public $id;
    public $movie_name;
    public $description;
    public $image;
    public $time;
    public $user_id;
    public User $user;
    public Array $categories;
    public Array $movies;

    public function __construct($id, $movie_name, $description, $image,$time, $user_id){
        $this->id = $id;
        $this->movie_name = $movie_name;
        $this->description = $description;
        $this->image = $image;
        $this->time = $time;
        $this->user_id= $user_id;
    }


}
