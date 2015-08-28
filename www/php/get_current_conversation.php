<?php

header('Access-Control-Allow-Origin: *');


$ID = htmlspecialchars($_GET['conversationID']);

$dbHost = 'localhost';
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}


$sqlConv = "SELECT * FROM conversation WHERE id = '$ID'";
if ($result=mysqli_query($conn,$sqlConv))
{
    $conversation = $result->fetch_assoc();
}


$sqlUser = "SELECT id,name,picThumbnail FROM user WHERE id = '%s'";
# Fetch the info for user1
$user1Query = sprintf($sqlUser, $conversation['user1']);
if ($result=mysqli_query($conn, $user1Query))
{
    if ($row = $result->fetch_assoc())
    {
        $user1 = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'picThumbnail' => $row['picThumbnail'],
        );
    }
}
# Fecth the info for user2
$user2Query = sprintf($sqlUser, $conversation['user2']);
if ($result=mysqli_query($conn, $user2Query))
{
    if ($row = $result->fetch_assoc())
    {
        $conversation = array(
            'id' => $conversation['id'],
            'tripID' => $conversation['tripId'],
            'time' => $conversation['time'],
            'user1ID' => $user1['id'],
            'user1Name' => $user1['name'],
            'user1Thumbnail' => $user1['picThumbnail'],
            'user2ID' => $row['id'],
            'user2Name' => $row['name'],
            'user2Thumbnail' => $row['picThumbnail'] 
        ); 
    }
}
$conn->close();

$jsonstring = json_encode($conversation);
echo $jsonstring;

?>