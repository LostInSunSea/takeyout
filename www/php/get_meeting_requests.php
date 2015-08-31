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

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM meetingRequest INNER JOIN user ON meetingRequest.sentId = user.id WHERE receiveId = '$id'";

$json = array();

if ($result=mysqli_query($conn,$sql)) {
    while ($row = mysqli_fetch_array($result))
    {
        $bus = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'picFull' => $row['picFull'],
            'date' => $row['date'],
            'time' => $row['time'],
            'place' => $row['place']
        );

        array_push($json, $bus);
    }
}

$jsonstring = json_encode($json);
echo $jsonstring;

$conn -> close();

?>