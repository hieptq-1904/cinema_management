<?php
use mvc\Models\Categories;
use mvc\Models\Movies;

class CategoryMovie{
    public $id;
    public $movie_id;
    public $category_id;
    public Categories  $category;
    public Movies $movie;

    public function __construct($id, $movie_id, $category_id)
    {
        $this->id = $id;
        $this->movie_id = $movie_id;
        $this->category_id = $category_id;
    }


}