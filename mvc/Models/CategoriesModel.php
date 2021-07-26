<?php
namespace mvc\Models;

class Categories{
    public $id;
    public $name;
    public $description;
    public Array $categories;

    public function __construct($id, $name, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }
}