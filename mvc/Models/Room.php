<?php
namespace mvc\Models;

class Room{
    public $id;
    public $room_name;
    public $number_of_seats;
    public $row_of_seats;
    public Array $movie_schedules;
    public function __construct($id, $room_name, $number_of_seats, $row_of_seats){
        $this->id = $id;
        $this->room_name = $room_name;
        $this->number_of_seats = $number_of_seats;
        $this->row_of_seats = $row_of_seats;
    }
}
