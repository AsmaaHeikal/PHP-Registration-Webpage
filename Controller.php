<?php

include 'DB_Ops.php';

$DB = new DBModel();
$conn = $DB->connect();

$msg = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($conn, $_POST['n']);
    $username = mysqli_real_escape_string($conn, $_POST['u']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['m']);
    $address = mysqli_real_escape_string($conn, $_POST['add']);
    $password = mysqli_real_escape_string($conn, $_POST['p']);
    $email = mysqli_real_escape_string($conn, $_POST['e']);


    // Check if the username and email already exists

    $result_username = $DB-> checkUsername($conn, $username);
    // $result_email = $DB-> checkUsername($conn, $email);

    if ( $result_username > 0) {
        echo "Username already exists! Please choose another username.";
    } 
    // elseif ($result_email > 0) {
    //     echo "Email already exists! Please choose another email address.";
    // }

    else {
        include 'Upload.php';
        if ($pic_error === null) {
            $user = new User($full_name, $username, $birthdate, $phone_number, $address, $password, $email, $fileNameNew);

            // Insert user data into the database
            if ($DB-> insert($conn, $user)) {
                echo "Registration Success";
            } else {
                echo "Error inserting data: " . mysqli_error($conn);
            }
        }
    }

}
