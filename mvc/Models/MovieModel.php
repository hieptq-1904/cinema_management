<?php
class MovieModel{
    public $id;
    public $movie_name;
    public $description;
    public $image;
    public $time;

    public function __construct($id, $movie_name, $description, $image,$time){
        $this->id = $id;
        $this->movie_name = $movie_name;
        $this->description = $description;
        $this->image = $image;
        $this->time = $time;
    }

}
