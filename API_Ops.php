<?php

session_start();

function extractId($str)
{
    $str = trim($str, '/');
    // Split the string by '/'
    $parts = explode('/', $str);
    // Return the last part which is the ID
    return end($parts);
}

function getActorDetails($actorId)
{
    // IMDb API endpoint URL
    $url = 'https://imdb8.p.rapidapi.com/actors/get-bio';

    // Parameters to be sent with the request
    $params = ['nconst' => $actorId];

    // Initialize cURL session
    $curl = curl_init();

    $api_host = "imdb8.p.rapidapi.com";
    $api_key = "d241b27257mshaa170cef6564df3p186393jsne82ab4ebb08f";

    // Set the cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url . '?' . http_build_query($params),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: " . $api_host,
            "X-RapidAPI-Key: " . $api_key
        ],
    ]);

    // Execute the request and fetch the response
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
        return null;
    } else {
        // Decode the JSON response
        $data = json_decode($response, true);
        return $data;
    }

    // Close cURL session
    curl_close($curl);
}

// Check if the form is submitted
if (isset($_POST['birthdate'])) {
    // Retrieve birthdate from the form
    $birthdate = $_POST['birthdate'];
    $_SESSION['birthdate'] = $birthdate;

    // IMDb API endpoint URL
    $url = 'https://imdb8.p.rapidapi.com/actors/list-born-today';

    // Parameters to be sent with the request
    $params = [
        'month' => date('m', strtotime($birthdate)), // Extract month from birthdate
        'day' => date('d', strtotime($birthdate)) // Extract day from birthdate
    ];

    // Initialize cURL session
    $curl = curl_init();

    $api_host = "imdb8.p.rapidapi.com";
    $api_key = "d241b27257mshaa170cef6564df3p186393jsne82ab4ebb08f";


    // Set the cURL options
    curl_setopt_array($curl, [
        CURLOPT_URL => $url . '?' . http_build_query($params),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: " . $api_host,
            "X-RapidAPI-Key: " . $api_key
        ],
    ]);
    // Execute the request and fetch the response
    $response = curl_exec($curl);

    // Check for errors
    if ($response === false) {
        echo 'Error: ' . curl_error($curl);
    } else {
        // Decode the JSON response
        $data = json_decode($response, true);

        $actorsNamesArray = [];

        // Add actors names in actorsNamesArray 

        if (!empty($data)) {
            foreach ($data as $actorId) {
                $actorDetails = getActorDetails(extractId($actorId));
                if ($actorDetails !== null) {
                    array_push($actorsNamesArray, $actorDetails['name']);
                }
            }
        }
        $_SESSION['actorsNamesArray'] = $actorsNamesArray;
    }

    // Close cURL session
    curl_close($curl);
}