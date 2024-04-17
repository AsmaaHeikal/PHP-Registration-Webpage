<?php
include 'Upload.php';

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
}

$DB = new DBModel();
$conn = $DB->connect();

$msg = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['n']);
    $username = mysqli_real_escape_string($conn, $_POST['u']);
    $birthdate =  mysqli_real_escape_string($conn, $_POST['birthdate']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['m']);
    $address = mysqli_real_escape_string($conn, $_POST['add']);
    $password =  mysqli_real_escape_string($conn, $_POST['p']);
    $email = mysqli_real_escape_string($conn, $_POST['e']);

    $targetDirectory = "uploads/"; 
    $targetFile = $targetDirectory . basename($_FILES["pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    
            // Check if the username and email already exists
            $check_username_query = "SELECT * FROM users WHERE user_name = '$username'";
            $check_email_query = "SELECT * FROM users WHERE email = '$email'";
            $result_username = mysqli_query($conn, $check_username_query);
            $result_email = mysqli_query($conn, $check_email_query);

            // The username already exists
            if (mysqli_num_rows($result_username) > 0) {
                echo "Username already exists! Please choose another username.";
            } elseif (mysqli_num_rows($result_email) > 0) {
                echo "Email already exists! Please choose another email address.";
            }

            // The username doesn't exist
            else {
            if ($pic_error === null) {
            $user = new User($full_name, $username, $birthdate, $phone_number, $address, $password, $email, $fileNameNew);

            // Insert user data into the database
            $insert_query = "INSERT INTO users (full_name, user_name, password, phone, address, birthdate, email, img_Name)
            VALUES ('$user->full_name', '$user->username', '$user->password', '$user->phone_number', '$user->address', '$user->birthdate', '$user->email', '$user->img_Name')";
            $res = mysqli_query($conn, $insert_query);
            
            if ($res) {
                echo "Registration Success";
            } else {
                echo "Error inserting data: " . mysqli_error($conn);
                 }
            }
        }
    
}
