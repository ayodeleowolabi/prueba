<?php
$name = "";
$country = "";
$timezone = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST["name_university"];
    $country = $_POST["country_name"];
    $timezone = $_POST["time_zone_name"];

    // Validation
    if (empty($name) || empty($country) || empty($timezone)) {
        $errorMessage = "All the fields are required";
    } else {
        // Database connection (ensure you have a $conn variable for your database connection)
        $conn = new mysqli('localhost', 'root', '', 'linguameeting');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL query to insert new university
        $stmt = $conn->prepare("INSERT INTO universities (id_university, name_university, country_name, time_zone_name) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_university, $name, $country, $timezone);  // Add an integer parameter for id_university
        

        if ($stmt->execute()) {
            $successMessage = "University Added Successfully";
            // Clear form values after successful insertion
            $name = "";
            $country = "";
            $timezone = "";
        } else {
            $errorMessage = "Error adding university: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba</title>
</head>
<body>
    <div class="container">
        <h2>New University</h2>
        <?php if (!empty($errorMessage)): ?>
            <div><strong><?= $errorMessage ?></strong></div>
        <?php endif; ?>

        <form method="post">
            <label>Name:</label>
            <div><input type="text" name="name_university" value="<?= htmlspecialchars($name) ?>"></div>

            <label>Country:</label>
            <div><input type="text" name="country_name" value="<?= htmlspecialchars($country) ?>"></div>

            <label>Timezone:</label>
            <div><input type="text" name="time_zone_name" value="<?= htmlspecialchars($timezone) ?>"></div>

            <?php if (!empty($successMessage)): ?>
                <div><strong><?= $successMessage ?></strong></div>
            <?php endif; ?>

            <div><button type="submit">Submit</button></div>
            <div><a href="index.php" role="button">Cancel</a></div>
        </form>
    </div>
</body>
</html>
