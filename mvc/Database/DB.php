<?php
namespace mvc\Database;
use mvc\Models\CategoryMovie;
use mysqli;
use mvc\Models\Movie;
use mvc\Models\Category;
use mvc\Models\Room;
require_once 'mvc/Models/Movie.php';
require_once 'mvc/Models/Category.php';
require_once 'mvc/Models/Room.php';

class DB
{
    public $conn;
    protected $servername = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbname = "cinema_management";

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function checkLogin($username,$password){
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result) > 0) {
            $row= $result->fetch_assoc();
            $user = $row['id'];
            return $user;
        }else{
            return false;
        }
    }

    public function checkRegister($username, $email, $password, $name, $phone, $address){
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1";
        $result = mysqli_query($this->conn,$sql);
        if(mysqli_num_rows($result) <= 0){
            $sql = "INSERT INTO users (username, password, name, email, phone, address ) 
                    VALUES ('$username', '$password', '$name', '$email', '$phone', '$address')";
            mysqli_query($this->conn,$sql);
            return true;
        }else{
            return false;
        }
    }
    public function showMovie(){
        $sql = "SELECT * FROM movies ";
        $result = mysqli_query($this->conn,$sql);
        $list = [];
        if(mysqli_num_rows($result) > 0){
            while ($row = $result->fetch_assoc()){
                $movie = new Movie($row['id'], $row['movie_name'], $row['description'], $row['image'],$row['time'],
                    $row['user_id']);
                array_push($list, $movie);
            }
            return $list;
        }
        else{
            return false;
        }

    }
        public function showCategory(){
        $sql = "SELECT * FROM categories";
        $result = mysqli_query($this->conn,$sql);
        $list = [];
        if(mysqli_num_rows($result) >0){
            while ($row = $result->fetch_assoc()){
                $category = new Category($row['id'], $row['name'], $row['description'] );
                array_push($list,$category);
            }
            return $list;
        }else{
            return false;
        }
    }

    public function addMovie($id_category,$movie_name,$description,$image,$time){
        $user_id = $_SESSION['user_id'];
        $list =  implode(", ", $id_category);
        $sql_category = "SELECT id FROM categories WHERE id in ($list)";
        $result= $this->conn->query($sql_category);
        if($result->num_rows > 0){
            $sql_movie = "INSERT INTO movies(movie_name, description, image, time, user_id) 
                        VALUES ('$movie_name', '$description', '$image', '$time', '$user_id')";
            if ($this->conn->query($sql_movie) === true) {
                $movie_id = $this->conn->insert_id;
                while($row= $result->fetch_assoc()){
                    $id_cate = $row['id'];
                    $sql_cate = "INSERT INTO category_movie(movie_id, category_id) VALUES ($movie_id, $id_cate)";
                    $qr = $this->conn->query($sql_cate);
                    if(!$qr){
                        return false;
                    }
                }
            }else {
                return false;
            }
        }else{
            return false;
        }

    }

    public function deleteMovie($movie_id){
        $sql = "SELECT * FROM movies WHERE id = '$movie_id' LIMIT 1";
        $query = $this->conn->query($sql);
        if($query->num_rows > 0){
            $row = mysqli_fetch_assoc($query);
            unlink('public/image/'.$row['image']);
            $sql = "DELETE FROM category_movie WHERE movie_id = '$movie_id'";
            if ($this->conn->query($sql) === TRUE) {
                $sql_movie = "DELETE FROM movies WHERE id = '$movie_id'";
                $this->conn->query($sql_movie);
                return true;
            }
        }else{
            return false;
        }
    }

    public function detailMovie($id){
        $sql = "SELECT * FROM movies WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        $list = [];
        if($result->num_rows > 0){
            $sql = "SELECT * FROM categories,category_movie WHERE category_movie.movie_id = '$id'AND category_movie.category_id= categories.id";
            $qr =$this->conn->query($sql);
            while ($row = $qr->fetch_assoc()){
                $categories = new Category( $row['id'], $row['name'], $row['description']);
                array_push($list,$categories);
            }
            $row = $result->fetch_assoc();
            $movie = new Movie($row['id'], $row['movie_name'], $row['description'], $row['image'],$row['time'],$row['user_id'],$list);
            return $movie;
        }else{
            return false;
        }
    }

    public function updateMovie($id,$id_category,$movie_name,$description,$file, $time){
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM movies WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            if ($file != '') {
                $sql_movie = "UPDATE movies SET movie_name = '$movie_name', description = '$description', image='$file', 
                    time = '$time', user_id = '$user_id' WHERE id = '$id' ";
            } else {
                $sql_movie = "UPDATE movies SET movie_name = '$movie_name', description = '$description',
                    time = '$time', user_id = '$user_id' WHERE id = '$id' ";
            }
            $qr = $this->conn->query($sql_movie);
            if($qr == true){
                if ($id_category) {
                    $sql = "DELETE FROM category_movie WHERE movie_id = '$id'";
                    $this->conn->query($sql);
                    $list =  str_replace(" ", "", implode(", ", $id_category));
                    $sql_category = "SELECT id FROM categories WHERE id in ($list)";
                    $result2 = $this->conn->query($sql_category);
                    if($result2->num_rows > 0){
                        while ($row = $result2->fetch_assoc()){
                            $id_cate = $row['id'];
                            $sql_cate = "INSERT INTO category_movie(movie_id, category_id) VALUES ($id, $id_cate)";
                            $this->conn->query($sql_cate);
                        }
                    }
                }

            }
        }
        return true;
    }

    public function showRoom(){
        $sql = "SELECT * FROM rooms";
        $result = mysqli_query($this->conn,$sql);
        $list = [];
        if(mysqli_num_rows($result) >0){
            while ($row = $result->fetch_assoc()){
                $room = new Room($row['id'], $row['room_name'], $row['number_of_seats'],$row['row_of_seats']  );
                array_push($list,$room);
            }
            return $list;
        }else{
            return false;
        }
    }

    public function setMovieSchedule($start_time,$end_time,$date,$movie_id,$room_id){
        $sql_room = "SELECT id FROM rooms WHERE id = '$room_id'";
        $query = $this->conn->query($sql_room);
        if($query->num_rows > 0){
            $id_room = $query->fetch_assoc();
        }
        $sql_movie = "SELECT id FROM movies WHERE id = '$movie_id' ";
        $qr = $this->conn->query($sql_movie);
        if($qr->num_rows > 0){
            $id_movie = $qr->fetch_assoc();
            $sql = "INSERT INTO movie_schedule(start_time,end_time,date,movie_id,room_id) 
                    VALUES($start_time,$end_time, $date,$id_movie,$id_room) ";
            $result = $this->conn->query($sql);
        }

    }


    public function closeDb(){
        return $this->conn->close();
    }

}

