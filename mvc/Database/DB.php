<?php
namespace mvc\Database;
use mvc\Models\CategoryMovie;
use mysqli;
use mvc\Models\Movie;
use mvc\Models\Category;
require_once 'mvc/Models/Movie.php';
require_once 'mvc/Models/Category.php';

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
                    $row['user_id'],);
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
        $sql_category = "SELECT id FROM categories WHERE id = '$id_category'";
        $result= $this->conn->query($sql_category);
        if($result->num_rows >0){
            $category_id = $result->fetch_assoc();
            $id_cate = reset($category_id);
        }
        $sql_movie = "INSERT INTO movies(movie_name, description, image, time, user_id) 
                        VALUES ('$movie_name', '$description', '$image', '$time', '$user_id')";
        if ($this->conn->query($sql_movie) === TRUE) {
            $movie_id = $this->conn->insert_id;;
            $sql_cate = "INSERT INTO category_movie(movie_id, category_id) VALUES ('$movie_id', '$id_cate')";
            if($this->conn->query($sql_cate) === TRUE){
                return true;
            }
        }else {
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
        $sql = "SELECT * FROM category_movie WHERE movie_id = '$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $sql_movie = "SELECT * FROM movies WHERE id = '$id'";
            $query = $this->conn->query($sql_movie);
            $row = $query->fetch_assoc();

        }
    }


    public function closeDb(){
        return $this->conn->close();
    }

}

