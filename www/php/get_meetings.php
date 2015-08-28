<?php

session_start();

if (!isset($_SESSION['id']))
{
    exit ("Error: Not logged in!");
}

$id = $_SESSION["id"];

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT meeting.date, meeting.time, meeting.place, user.id, user.name, user.picFull
        FROM meeting INNER JOIN user ON (user1 = user.id OR user2 = user.id)
        WHERE user1 = '$id' OR user2 = '$id'";

$json = array();

if ($result=mysqli_query($conn,$sql))
{
    while ($row = mysqli_fetch_array($result))
    {
        if ($row['id'] != $id)
        {
            $bus = array(
                'date' => $row['date'],
                'time' => $row['time'],
                'place' => $row['place'],
                'picFull' => $row['picFull'],
                'id' => $row['id'],
                'name' => $row['name'],
            );
            array_push($json, $bus);
        }
    }
}
$jsonstring = json_encode($json);
echo $jsonstring;

$conn->close();
?>