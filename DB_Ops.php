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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $Full_Name = mysqli_real_escape_string($conn, $_POST['n']);
    $username = mysqli_real_escape_string($conn, $_POST['u']);
    $Birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $Phone_Number = mysqli_real_escape_string($conn, $_POST['m']);
    $Password = mysqli_real_escape_string($conn, $_POST['p']);
    $Confirm_Password = mysqli_real_escape_string($conn, $_POST['cp']);
    $Email = mysqli_real_escape_string($conn, $_POST['e']);

    $targetDirectory = "uploads/"; 
    $targetFile = $targetDirectory . basename($_FILES["pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (empty($Full_Name) || empty($username) || empty($Birthdate) || empty($Phone_Number) || empty($Password) || empty($Confirm_Password) || empty($Email)) {
        echo "- Please enter all required fields";
    } else {
        
        $check_username_query = "SELECT * FROM users WHERE username = '$username'";
        $check_email_query = "SELECT * FROM users WHERE email = '$Email'";
        $result_username = mysqli_query($conn, $check_username_query);
        $result_email = mysqli_query($conn, $check_email_query);
        
        if (mysqli_num_rows($result_username) > 0) {
            echo "Username already exists! Please choose another username.";
        } elseif (mysqli_num_rows($result_email) > 0) {
            echo "Email already exists! Please choose another email address.";
        } else {
            $hash = password_hash($Password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (full_name, username, birthdate, phone_number, password, email, profile_picture) 
            VALUES ('$Full_Name', '$username', '$Birthdate', '$Phone_Number', '$Password', '$Email', '$targetFile')";
            $res = mysqli_query($conn, $query);
            
            if ($res) {
                echo "Registration Success";
            } else {
                echo "Error inserting data: " . mysqli_error($conn);
            }
        }
    }
}


?>
