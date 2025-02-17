<?php

$conn = new mysqli('localhost', 'root', '', 'linguameeting');

$id = "";
$name = "";
$country = "";
$timezone = "";
$errorMessage = "";
$successMessage = "";

// Check if the request is GET (loading the edit page)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['id'])) {
        header("location:/index.php");
        exit;
    }

    $id = $_GET["id"];
    $sql = "SELECT * FROM universities WHERE id_university=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:/index.php");
        exit;
    }

    $name = $row["name_university"];
    $country = $row["country_name"];
    $timezone = $row["time_zone_name"];

} else {
    // Handle form submission for updating university
    $id = $_POST["id"];
    $name = $_POST["name_university"];
    $country = $_POST["country_name"];
    $timezone = $_POST["time_zone_name"];

    do {
        if (empty($name) || empty($country) || empty($timezone)) {
            $errorMessage = "All fields are required";
            break;
        }

        // Correct update statement
        $sql = "UPDATE universities 
                SET name_university = '$name', 
                    country_name = '$country', 
                    time_zone_name = '$timezone' 
                WHERE id_university = $id";

        // Debugging: Print SQL query
        // echo "Executing SQL: " . $sql;  // Remove this line in production

        $result = $conn->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $conn->error;
            break;
        }

        // After a successful update, redirect to index.php to avoid re-submission
        $successMessage = "University updated successfully";
        
        // Redirect using header and exit to stop further processing
        header("Location:/index.php");
        exit;

    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit University</title>
</head>
<body>
    <div class="container">
        <h2>Edit University</h2>
        
        <?php if (!empty($errorMessage)): ?>
            <div><strong><?= $errorMessage ?></strong></div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <label>Name:</label>
            <div><input type="text" name="name_university" value="<?= htmlspecialchars($name) ?>"></div>

            <label>Country:</label>
            <div><input type="text" name="country_name" value="<?= htmlspecialchars($country) ?>"></div>

            <label>Timezone:</label>
            <div><input type="text" name="time_zone_name" value="<?= htmlspecialchars($timezone) ?>"></div>

            <?php if (!empty($successMessage)): ?>
                <div><strong><?= $successMessage ?></strong></div>
            <?php endif; ?>

            <div><button type="submit">Update</button></div>
            <div><a href="index.php" role="button">Cancel</a></div>
        </form>
    </div>
</body>
</html>
