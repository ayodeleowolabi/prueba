<?php

if (isset($_GET["id"])){
    $id = (int) $_GET["id"];
    $conn = new mysqli('localhost', 'root', '', 'linguameeting');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM universities WHERE id_university =?");
    var_dump($stmt);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    var_dump($stmt);

    $stmt->close();
    $conn->close();
    header("location:index.php");
    exit;
} else {
    die("No ID provided for deletion.");
}


?>