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
   // public $profile_picture;

    public function __construct($full_name, $username, $birthdate, $phone_number, $address, $password, $email)//, $profile_picture)
    {
        $this->full_name = $full_name;
        $this->username = $username;
        $this->birthdate = $birthdate;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $this->password = $password;
        $this->email = $email;
        // $this->profile_picture = $profile_picture;
    }
}

// Database class
Class DBModel
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
    $full_name = $_POST['n'];
    $username = $_POST['u'];
    $birthdate = $_POST['birthdate'];
    $phone_number = $_POST['m'];
    $address = $_POST['add'];
    $password = $_POST['p'];
    // $profile_picture = $_POST['pic'];
    $email = $_POST['e'];

    // Check if the username already exists
    $check_query = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn, $check_query);

    // The username already exists
    if (mysqli_num_rows($result) > 0) {
        $msg = "Username already exists! Please choose another username.";
        echo "<script>alert('$msg');</script>";
    } 

    // The username doesn't exist
    else {

        $user = new User($full_name, $username, $birthdate, $phone_number, $address, $password, $email);//, $profile_picture);

        // Insert user data into the database
        $insert_query = "INSERT INTO users (full_name, user_name, password, phone, address, birthdate, email)
            VALUES ('$user->full_name', '$user->username', '$user->password', '$user->phone_number', '$user->address', '$user->birthdate', '$user->email')";//, '$user->profile_picture')";
        
        if (mysqli_query($conn, $insert_query)) {
            $msg = "Registration successful!";
            echo "<script>alert('$msg');</script>";
        }
        else {
            $msg = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            echo $msg;
        }
    }
}
?>

