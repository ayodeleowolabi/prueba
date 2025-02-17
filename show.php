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
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Courses</h1>

        <?php if (empty($getCourses)) { ?>
            <p class="text-center">There are no courses listed.</p>
        <?php } else { ?>
            <div class="row">
                <?php foreach ($getCourses as $course) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($course["name_course"]); ?></h5>
                                <p class="card-text"><strong>Semester:</strong> <?= htmlspecialchars($course["semester_name"]); ?></p>
                                <p class="card-text"><strong>Year:</strong> <?= htmlspecialchars($course["year"]); ?></p>
                                <p class="card-text"><strong>Language:</strong> <?= htmlspecialchars($course["language_name"]); ?></p>
                                <p class="card-text"><strong>Start Date:</strong> <?= htmlspecialchars($course["date_ini_course"]); ?></p>
                                <p class="card-text"><strong>End Date:</strong> <?= htmlspecialchars($course["date_end_course"]); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="text-center mt-4">
            <a href="/" class="btn btn-secondary">All Universities</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
