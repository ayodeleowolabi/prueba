<?php
include('auth/auth.php');
include('auth/getuniversities.php');
include('auth/getcourses.php');

$id = $_GET["id_university"];


/* for($x = 0; $x < count($getUniversities); $x++){
    echo $getUniversities[$x]["name_university"] . "<br>";
    echo $getUniversities[$x]["id_university"] . "<br>";
    echo $getUniversities[$x]["country_name"] . "<br>";
    echo $getUniversities[$x]["time_zone_name"] . "<br>";
    echo "<hr/>";
}
    */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 style="text-align: center;">Courses</h1>
    <?php $data[0]?>
  
    
</body>
</html>