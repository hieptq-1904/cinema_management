<?php
namespace mvc\Database;
use mysqli;

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
            return $row;
        }
    }


    public function closeDb(){
        return $this->conn->close();
    }

}

