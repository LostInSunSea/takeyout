<?php

$dbHost = 'http://45.55.30.181';
$dbUser = "root";
$dbPass = "keyboard cat";
$dbDatabase = "SDHacks2015";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM stories";

if ($result=mysqli_query($conn,$sql)) {
    echo $result;
}

?>