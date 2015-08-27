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

$sql = "SELECT id FROM conversation WHERE user1 = '$ID' OR user2 = '$ID'";
if ($result=mysqli_query($conn,$sql))
{
    if (mysqli_num_rows($result))
    {		
        $jsonstring = json_encode($result);
        echo $jsonstring;
    }
    else
    {
        $jsonstring = "{}";
        echo $jsonstring;
    }

}
$conn->close();

return $jsonstring;

?>