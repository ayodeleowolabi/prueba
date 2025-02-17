<?php
// universitiesList.php

function universitiesList($conn) {
    $sql = "SELECT * FROM universities";
    $result = $conn->query($sql); // Execute the query

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC); // Return the results as an associative array
    } else {
        return null; // Return null if there was an error executing the query
    }
}
?>
