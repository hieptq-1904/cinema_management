<?php
class MovieScheduleModel{
    public $id;
    public $time;
    public $date;

    public function __construct($id, $time, $date){
        $this->id = $id;
        $this->time = $time;
        $this->date = $date;
    }

}
