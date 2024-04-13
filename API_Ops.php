<?php

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
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key: 9b15487c95msh7e88ddbf1911757p156155jsnfffc48511d43"
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

    // IMDb API endpoint URL
    $url = 'https://imdb8.p.rapidapi.com/actors/list-born-today';

    // Parameters to be sent with the request
    $params = [
        'month' => date('m', strtotime($birthdate)), // Extract month from birthdate
        'day' => date('d', strtotime($birthdate)) // Extract day from birthdate
    ];

    // Initialize cURL session
    $curl = curl_init();

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
            "X-RapidAPI-Host: imdb8.p.rapidapi.com",
            "X-RapidAPI-Key: 9b15487c95msh7e88ddbf1911757p156155jsnfffc48511d43"
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

        // Display the names of actors born on the same day
        echo '<h2>Actors Born on ' . date('F j, Y', strtotime($birthdate)) . '</h2>';
        if (!empty($data)) {
            echo '<ul>';
            foreach ($data as $actorId) {
                $actorDetails = getActorDetails(extractId($actorId));
                if ($actorDetails !== null) {
                    echo '<li>' . $actorDetails['name'] . '</li>';
                }
            }
            echo '</ul>';
        } else {
            echo '<p>No actors found.</p>';
        }
    }

    // Close cURL session
    curl_close($curl);
}
