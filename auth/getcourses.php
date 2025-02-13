<?php
include("auth/auth.php");
include("auth/getuniversities.php");

$courseid = $_SERVER["QUERY_STRING"];
$parseid = parse_str($courseid, $output);
$id = $output['id'];
$university = $getUniversities[$id];

$ch = curl_init("http://develop.linguameeting.com/API/develop/api_rest.php/getCourses?$id");


curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Authorization: $response_data->token", "content-type: application/json","id:$id" ]

]);

$allcourses = curl_exec($ch);
$allcourses_data = json_decode($allcourses, true);
$getCourses = $allcourses_data["data"];






curl_close($ch);
echo $allcourses_data["message"];
var_dump($university) ;
echo $output['id'];
echo $id

// var_dump($id);
// for($x = 0; $x < count($getCourses); $x++ ){
//     echo $getCourses[$id];
// }


?>