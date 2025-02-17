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
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">New University</h2>
        
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="name_university" class="form-label">Name:</label>
                <input type="text" name="name_university" id="name_university" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
            </div>

            <div class="mb-3">
                <label for="country_name" class="form-label">Country:</label>
                <input type="text" name="country_name" id="country_name" class="form-control" value="<?= htmlspecialchars($country) ?>" required>
            </div>

            <div class="mb-3">
                <label for="time_zone_name" class="form-label">Timezone:</label>
                <input type="text" name="time_zone_name" id="time_zone_name" class="form-control" value="<?= htmlspecialchars($timezone) ?>" required>
            </div>

            <?php if (!empty($successMessage)): ?>
                <div class="alert alert-success"><?= $successMessage ?></div>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>