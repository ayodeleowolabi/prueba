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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Edit University</h2>

            <?php if (!empty($errorMessage)): ?>
                <div class="alert alert-danger"><?= $errorMessage ?></div>
            <?php endif; ?>

            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name_university" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Country:</label>
                    <input type="text" name="country_name" class="form-control" value="<?= htmlspecialchars($country) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Timezone:</label>
                    <input type="text" name="time_zone_name" class="form-control" value="<?= htmlspecialchars($timezone) ?>" required>
                </div>

                <?php if (!empty($successMessage)): ?>
                    <div class="alert alert-success"><?= $successMessage ?></div>
                <?php endif; ?>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
