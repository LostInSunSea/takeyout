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
    while($row = mysqli_fetch_array($result))
    {
        $conv = array(
            'id' => $row['id'],
            'user1' => $row['user1'],
            'user2' => $row['user2'],
            'time' => $row['time']
        );
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

    array_push($json, $conv);

}
$conn->close();

return $json;

?>