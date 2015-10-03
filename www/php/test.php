<?php

$dbHost = 'kawaiikrew.net';
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user";

$json = array();

if ($result=mysqli_query($conn,$sql)) {
    while ($row = mysqli_fetch_array($result))
    {
        $bus = array(
            'name' => $row['name']
        );

        array_push($json, $bus);
    }
}

$jsonstring = json_encode($json);
echo $jsonstring;

$conn -> close();

?>