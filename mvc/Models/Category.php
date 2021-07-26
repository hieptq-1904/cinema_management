<?php
namespace mvc\Models;

class Category{
    public $id;
    public $name;
    public $description;
    public Array $movies;

    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}