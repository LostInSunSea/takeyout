<?php
	
	$ID = htmlspecialchars($_GET['id']);
	$sID= htmlspecialchars($_SESSION['id']);

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

$sql = "SELECT * FROM conversation WHERE user1 = '$sID' OR user2 = '$sID' AND tripId = '$ID'";
if ($result=mysqli_query($conn,$sql))
{
    while ($row = $result->fetch_assoc())
    {
        array_push($json, $row);
    }

}
$conn->close();

$jsonstring = json_encode($json);
echo $jsonstring;

?>