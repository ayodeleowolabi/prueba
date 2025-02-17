<?php
// include('auth/auth.php');

// include('auth/getuniversities.php');
include('auth/getcourses.php');
if (!isset($_GET['id'])) {
    $id = ''; // or provide a default value
} else {
    $id = null;
}

// var_dump($id);


// var_dump($getCourses)

/* for($x = 0; $x < count($getUniversities); $x++){
    echo $getUniversities[$x]["name_university"] . "<br>";
    echo $getUniversities[$x]["id_university"] . "<br>";
    echo $getUniversities[$x]["country_name"] . "<br>";
    echo $getUniversities[$x]["time_zone_name"] . "<br>";
    echo "<hr/>"; 
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
    <?php if (empty($getCourses)) { ?>
    <p>There are no courses listed.</p>
<?php } else { ?>
    <?php foreach ($getCourses as $course) { ?>
        <div class="details">
            <h3> <?= htmlspecialchars($course["name_course"]); ?> </h3>
            <p><strong>Semester:</strong> <?= htmlspecialchars($course["semester_name"]); ?></p>
            <p><strong>Year:</strong> <?= htmlspecialchars($course["year"]); ?></p>
            <p><strong>Language:</strong> <?= htmlspecialchars($course["language_name"]); ?></p>
            <p><strong>Start Date:</strong> <?= htmlspecialchars($course["date_ini_course"]); ?></p>
            <p><strong>End Date:</strong> <?= htmlspecialchars($course["date_end_course"]); ?></p>
        </div>
    <?php } ?>
<?php } ?>
<button><a href="/">All Universities</a></button>

  
    
</body>
</html>