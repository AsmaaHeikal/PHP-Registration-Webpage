<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "registerationdb";

$conn = mysqli_connect($server, $username, $password) or die("Couldn't connect to server" . mysqli_error($conn));
mysqli_select_db($conn, $database) or die("Couldn't select database" . mysqli_error($conn));

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['n'];
    $username = $_POST['u'];
    $birthdate = $_POST['yy'] . '-' . $_POST['mm'] . '-' . $_POST['dd'];
    $phone_number = $_POST['m'];
    $address = $_POST['add'];
    $password = $_POST['p'];
    // $profile_picture = $_POST['pic'];
    $email = $_POST['e'];

    $check_query = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        $msg = "Username already exists! Please choose another username.";
        echo "<script>alert('$msg');</script>";
    } 
    else {
        $insert_query = "INSERT INTO users (full_name, user_name, password, phone, address, birthdate, email) 
            VALUES ('$full_name', '$username', '$password', '$phone_number', '$address', '$birthdate', '$email')";
        
        if (mysqli_query($conn, $insert_query)) {
            $msg = "Registration successful!";
            echo "<script>alert('$msg');</script>";
        } else {
            $msg = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            echo "<script>alert('$msg');</script>";
        }
    }
}

