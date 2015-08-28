<?php

session_start();
if (!isset($_SESSION['id']))
{
    exit ("Error: Not logged in!");
}

$dbHost = 'localhost';
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$id = $_SESSION['id'];

$friend = $_POST['userId'];
$date = $_POST['date'];
$time = $_POST['time'];
$place = $_POST['place'];

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO meeting (id, user1, user2, date, time, place)
        VALUES (NULL, '$id', '$friend', '$date', '$time', '$place')";

if (mysqli_query($conn, $sql))
{
    echo "Success";
}
else
{
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();

?>