<?php
use mvc\Models\Movie;
use mvc\Models\Room;

class MovieSchedule{
    public $id;
    public $time;
    public $date;
    public $movie_id;
    public $room_id;
    public Room $room;
    public Movie  $movie;

    public function __construct($id, $time, $date, $movie_id, $room_id)
    {
        $this->id = $id;
        $this->time = $time;
        $this->date = $date;
        $this->movie_id = $movie_id;
        $this->room_id = $room_id;
    }


}
