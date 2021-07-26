<?php

class CategoryMovie{
    public $id;
    public $movie_id;
    public $category_id;

    public function __construct($id, $movie_id, $category_id)
    {
        $this->id = $id;
        $this->movie_id = $movie_id;
        $this->category_id = $category_id;
    }


}