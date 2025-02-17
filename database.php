<?php 
$db_server = "localhost";
$db_user = "root";
$db_password = "123456";
$db_name = "linguameeting";
$conn = "";


$conn = mysqli_connect($db_server, 
$db_user,
$db_password, 
$db_name);

if($conn){
    echo "You are connected";
} else {
    echo "No connection";
}
?>
