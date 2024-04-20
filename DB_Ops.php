<?php

// User class
class User
{
    public $full_name;
    public $username;
    public $birthdate;
    public $phone_number;
    public $address;
    public $password;
    public $email;
    public $img_Name;


    public function __construct($full_name, $username, $birthdate, $phone_number, $address, $password, $email, $fileNameNew)
    {
        $this->full_name = $full_name;
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->password = $password;
        $this->email = $email;
        $this->img_Name = $fileNameNew;
    }
}

// Database class
class DBModel
{
    private $username;
    private $host;
    private $password;
    private $database;
    public function __construct()
    {
        $this->username = "root";
        $this->host = "localhost";
        $this->password = "";
        $this->database = "registrationdb";
    }
    public function connect()
    {
        $conn = mysqli_connect($this->host, $this->username, $this->password) or die("Couldn't connect to server" . mysqli_error($conn));
        mysqli_select_db($conn, $this->database) or die("Couldn't select database" . mysqli_error($conn));
        return $conn;
    }
    public function insert($conn, $user)
    {
        $insert_query = "INSERT INTO users (full_name, user_name, password, phone, address, birthdate, email, img_Name)
        VALUES ('$user->full_name', '$user->username', '$user->password', '$user->phone_number', '$user->address', '$user->birthdate', '$user->email', '$user->img_Name')";
        $res = mysqli_query($conn, $insert_query);
        return $res;
    }
    public function checkUsername($conn, $username){
        $check_username_query = "SELECT * FROM users WHERE user_name = '$username'";
        $result_username = mysqli_query($conn, $check_username_query);
        return mysqli_num_rows($result_username);
    }

    public function checkEmail($conn, $email){
        $check_email_query = "SELECT * FROM users WHERE email = '$email'";
        $result_email = mysqli_query($conn, $check_email_query);
        return mysqli_num_rows($result_email);
    }
    
    public function close($conn)
    {
        mysqli_close($conn);
    }
}

