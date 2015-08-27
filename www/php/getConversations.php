<?php

$ID = htmlspecialchars($_GET['userID']);

$dbHost = 'localhost';
$dbUser = "root";
$dbPass = "J^mpStrt";
$dbDatabase = "takeyout";

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$json = array();

$sql = "SELECT * FROM conversation WHERE user1 = '$ID' OR user2 = '$ID'";
if ($result=mysqli_query($conn,$sql))
{
    while ($row = $result->fetch_assoc())
    {
        $conv = json_encode($row);
        array_push($json, $conv);
    }
    /*if (mysqli_num_rows($result))
    {		
        $result = $result->fetch_assoc();
        $jsonstring = json_encode($result);
        echo $jsonstring;
    }
    else
    {
        $jsonstring = "{}";
        echo $jsonstring;
    }*/


}
$conn->close();

echo $json;
return $json;

?>