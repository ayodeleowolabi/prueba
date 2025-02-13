<?php
include("auth/auth.php");
$ch = curl_init("http://develop.linguameeting.com/API/develop/api_rest.php/getUniversities");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Authorization: $response_data->token", "content-type: application/json"]

]);

$allunis = curl_exec($ch);
$allunis_data = json_decode($allunis, true);
$getUniversities = $allunis_data["data"];


curl_close($ch);






?>