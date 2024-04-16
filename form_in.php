<?php 
include "DB_Ops.php";
if (isset($_POST['n']) || isset ($_POST['u']) || isset ($_POST['birthdate'])
|| isset ($_POST['m']) || isset ($_POST['p']) || isset ($_POST['cp'])||isset($_POST['e']) )  {
    $Full_Name= $_POST['n'];
    $username = $_POST['u'];
    $Birthdate= $_POST['birthdate'];
    $Phone_Number= $_POST['m'];
    $Password = $_POST['p'] ;
    $Confirm_Password =$_POST['cp'];
    $Email=$_POST['e'];


     if (empty($Full_Name) || empty($username) || empty($Birthdate)
     || empty($Phone_Number)|| empty($Password)|| empty($Confirm_Password)|| empty($Email)) 
         echo "- Please enter all required fields";

    else{
        if (empty($Full_Name)){
            echo " - Full name is empty Fields<br>";
        }
        else if (preg_match("/^[a-zA-Z ]*$/", $Full_Name)) {
             } else {
            echo "- Full Name should contain only characters<br>";
        }



        if (!strtotime($Birthdate)) {
            echo "- Enter a valid birthdate.<br>";
        } else {
            $birthdateDateTime = new DateTime($Birthdate);
            $minBirthdate = new DateTime('1900-01-01');
            $maxBirthdate = new DateTime('2005-12-31');      
            if ($birthdateDateTime < $minBirthdate || $birthdateDateTime > $maxBirthdate) {
                echo "- The birthdate must be between 1900-01-01 and 2005-12-31.<br>";
            }
        }
        if (filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        } else {
            echo "- Invalid email format<br>";
        }


        if (!ctype_digit($Phone_Number)) {
            echo "- Enter the phone number correctly. It should only contain digits.<br>";
        } else if (strlen($Phone_Number) !== 10) {
            echo "- The phone number must consist of exactly 10 digits.<br>";
        }


        if ($Password != $Confirm_Password) {
            echo "- Passwords do not match.<br>";
        }else if (strlen($Password) >= 8 && preg_match("/[A-Z]/", $Password) && preg_match("/[a-z]/", $Password) && preg_match("/[0-9]/", $Password)) {
        } else {
            echo "- Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one digit.";
        }}
      
    }
?>
