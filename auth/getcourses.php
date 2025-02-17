<?php
include("auth/auth.php");
require_once(__DIR__ . '/universitiesList.php');

// include("auth/getuniversities.php");
$db_server = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_name = "linguameeting";
$db_port = 8889;
$conn = "";


$conn = mysqli_connect($db_server, 
$db_user,
$db_password, 
$db_name,
);

if($conn){
    echo "You are connected";
} else {
    echo "No connection";
}

$allUniversities = universitiesList($conn); // Get the universities list



$courseid = $_GET["id"];
// $id = (int) $output['id'];
$university = null;

if (isset($_GET['id'])) {
    $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
} else {
    // Handle error or set a default
    $id = null;
}

foreach ($allUniversities as $uni) {
    if ($uni['id_university'] == $id) {
        $university = $uni;
        break;
    }
}

if (!$university) {
    die("Error: University not found.");
}

$ch = curl_init("http://develop.linguameeting.com/API/develop/api_rest.php/getCourses?id=$id");


curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Authorization: $response_data->token", "content-type: application/json","id:$id" ]

]);

$allcourses = curl_exec($ch);
$allcourses_data = json_decode($allcourses, true);
$getCourses = $allcourses_data["data"];






curl_close($ch);

// var_dump($university) ;
// // var_dump($getUniversities);
// var_dump ($stringid);
// var_dump ($id);

// echo $id

// var_dump($id);
// for($x = 0; $x < count($getCourses); $x++ ){
//     echo $getCourses[$id];
// }
$stmt = $conn->prepare("
    INSERT INTO courses (name_course, year, date_ini_course, date_end_course, duration_sessions, language_name, semester_name, id_university)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ON DUPLICATE KEY UPDATE 
        name_course=VALUES(name_course), 
        year=VALUES(year), 
        date_ini_course=VALUES(date_ini_course), 
        date_end_course=VALUES(date_end_course), 
        duration_sessions=VALUES(duration_sessions), 
        language_name=VALUES(language_name), 
        semester_name=VALUES(semester_name), 
        id_university=VALUES(id_university)
");

$stmt->bind_param(
    "isssssss",  // The types of the parameters: 7 strings (name_course, year, date_ini, date_end, duration_sessions, language, semester, id_university)
    $name, 
    $year, 
    $date_ini, 
    $date_end, 
    $duration_sessions, 
    $language, 
    $semester,
    $university['id_university'] // Using the university ID from the `$university` array
);

foreach ($getCourses as $course) {
    $name = $course["name_course"];
    $year = $course["year"];
    $date_ini = $course["date_ini_course"];
    $date_end = $course["date_end_course"];
    $duration_sessions = $course["duration_sessions"];
    $language = $course["language_name"];
    $semester = $course["semester_name"];
    
    // if ($stmt->execute()) {
    //     echo "Inserted/Updated: $name <br>";
    // } else {
    //     echo "Error inserting $name: " . $stmt->error . "<br>";
    // }
}

$stmt->close();
$conn->close();
?>
