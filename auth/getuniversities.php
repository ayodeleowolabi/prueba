<?php
// include("auth/auth.php");
$db_server = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_name = "linguameeting";
$db_port = 8889;
$conn = "";


$conn = mysqli_connect($db_server, 
$db_user,
$db_password, 
$db_name,
);

// if($conn){
//     echo "You are connected";
// } else {
//     echo "No connection";
// }


$query = "SELECT * FROM universities";
$result = mysqli_query($conn, $query);

function universitiesList($conn) {
    $sql = "SELECT * FROM universities";
    $result = $conn->query($sql); // Execute the query

    if ($result) {
        return $result->fetch_all(MYSQLI_ASSOC); // Return the results as an associative array
    } else {
        return null; // Return null if there was an error executing the query
    }
}

$universities = universitiesList($conn);

if ($result) {
    echo "<div class='container mt-4'>";
    echo "<h2 class='text-center mb-4'>Universities</h2>";
    echo "<div class='d-flex justify-content-between mb-3'>"; 
    echo "<a href='create.php' class='btn btn-success btn-sm' style='padding-bottom: 10px;'>Add a University</a>"; 
    echo "</div>";   

    echo "<div class='table-responsive'>";
    echo "<table class='table table-bordered table-striped text-center'>
            <thead class='table-dark'>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Timezone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . htmlspecialchars($row['name_university']) . "</td>
            <td>" . htmlspecialchars($row['country_name']) . "</td>
            <td>" . htmlspecialchars($row['time_zone_name']) . "</td>
            <td>
                <div class='btn-group' role='group'>
                    <a href='show.php/?id=" . $row['id_university'] . "' class='btn btn-info btn-sm'>View</a>
                    <a href='edit.php/?id=" . $row['id_university'] . "' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='delete.php?id=" . $row['id_university'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this university?\")'>Delete</a>
                </div>
            </td>
        </tr>";
    }

    echo "</tbody></table></div></div><br>";
} else {
    echo "<div class='alert alert-danger'>Error fetching data: " . mysqli_error($conn) . "</div>";
}




$ch = curl_init("http://develop.linguameeting.com/API/develop/api_rest.php/getUniversities");

curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => ["Authorization: $response_data->token", "content-type: application/json"]

]);

$allunis = curl_exec($ch);
if ($allunis === false) {
    die("Error fetching universities: " . curl_error($ch));
}

// Decode JSON string into an associative array
$allunis = json_decode($allunis, true);

// Check if decoding was successful
if ($allunis && isset($allunis['data'])) {
    $getUniversities = $allunis['data']; // Now you have the array of universities
   
} else {
    echo "Error decoding JSON.";
}

// $allunis_data = json_decode($allunis["data"], true);


curl_close($ch);

$stmt = $conn->prepare("INSERT INTO universities (id_university, name_university, country_name, time_zone_name) VALUES (?, ?, ?, ?) 
    ON DUPLICATE KEY UPDATE name_university=VALUES(name_university), country_name=VALUES(country_name), time_zone_name=VALUES(time_zone_name)");

$stmt->bind_param("isss", $id, $name, $country, $timezone);

// Insert universities into the database
foreach ($getUniversities as $uni) {
    $id = $uni["id_university"];
    $name = $uni["name_university"];
    $country = $uni["country_name"];
    $timezone = $uni["time_zone_name"];

    // if ($stmt->execute()) {
    //     echo "Inserted/Updated: $name <br>";
    // } else {
    //     echo "Error inserting $name: " . $stmt->error . "<br>";
    // }
}




$stmt->close();
$conn->close();


?>