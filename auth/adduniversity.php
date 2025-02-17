<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input
    $name = $_POST["name_university"];
    $country = $_POST["country_name"];
    $timezone = $_POST["time_zone_name"];

    // Database connection (ensure you have a $conn variable for your database connection)
    $conn = new mysqli('host', 'root', '127.0.0.1', 'linguameeting');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert new university
    $stmt = $conn->prepare("INSERT INTO universities (name_university, country_name, time_zone_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $country, $timezone);  // 'ssi' means string, string, integer
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "New university added successfully.";
    } else {
        echo "Error adding university: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
