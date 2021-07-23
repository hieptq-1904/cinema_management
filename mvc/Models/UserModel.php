<?php
class UserModel{
    public $id;
    public $name;
    public $address;
    public $email;
    public $phone;
    public $username;
    public $password;

    public function __construct($id, $name, $address, $email, $phone, $username, $password){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->email = $email;
        $this->phone = $phone;
        $this->username = $username;
        $this->password = $password;
    }

}