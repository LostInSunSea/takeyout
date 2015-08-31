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

$requestId = $_POST['requestId'];

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM meetingRequest WHERE receiveId = '$id' AND id = '$requestId'";

if (mysqli_query($conn, $sql))
{
    echo '$id';
    echo '$requestId';
    echo "Success";
}
else
{
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();


?>