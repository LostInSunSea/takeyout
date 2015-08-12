<?php

session_start();

//TODO: uncomment this out
/*if (!isset($_SESSION['id']))
{
    exit ("Error: Not logged in!");
}*/

//TODO: Perform regular expression match to make sure it's actually in the format "city, country"

$locationString = htmlspecialchars($_GET['location']);
$location = explode(", ", $locationString);
$city = $location[0];
$country = $location[1];

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM locations WHERE name = '$city' AND type = 'city'";

if ($result = mysqli_query($conn, $sql))
{
    echo $result->num_rows;
    if($result->num_rows === 0)
    {
        echo "not found";
    }
    echo "found";
}

?>