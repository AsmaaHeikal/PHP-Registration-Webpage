<?php

$pic_error = null;

if(isset($_FILES['pic'])) {
    // Process the uploaded file
    $file = $_FILES['pic'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    // Check if the uploaded file is an image
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExts = array("jpg", "jpeg", "png", "gif");
    if (in_array($fileExt, $allowedExts)) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) { // 10MB limit
                //Store on the server
                if (!file_exists('images')) {
                    mkdir('images');
                }
                $fileNameNew = uniqid('', true) . "." . $fileExt;
                $fileDestination = "images/" . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            } 
            else $pic_error = "File is too large.";
        } 
        else  $pic_error = "Error uploading file.";
    } 
    else 
        $pic_error = "Invalid file type.";
} 
?>
