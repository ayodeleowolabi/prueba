<?php

$ch = curl_init();
$auth = [
"username" => "7UioU5xJyuypJ18FLvf7",
"password" => "aebc07912947e76f90f560aac9c1eec324b244b9ca27d679bfe082e070b4384c"
];

$headers = ["content-type: application/json"];

curl_setopt_array($ch, [
    CURLOPT_URL => "http://develop.linguameeting.com/API/develop/api_rest.php/auth",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($auth)
    


]);

$response = curl_exec($ch);
$response_data = json_decode($response);
$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// echo $response_data->token;

// echo $status_code;
?>