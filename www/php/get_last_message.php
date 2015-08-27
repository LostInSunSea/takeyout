<?php
	/*
    session_start();

    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $id = $_SESSION["id"];
	*/
	//this is temp for testing
	$id = $_GET["id"];
    $ID = htmlspecialchars($_GET['conversationID']);

    $dbHost = "localhost";
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM reply WHERE conversationId = '$ID' ORDER BY id DESC LIMIT 1";

    if ($result2=mysqli_query($conn,$sql)) {
        if (mysqli_num_rows($result2)) {
            $json = array();
            while ($row = mysqli_fetch_array($result2)) {
                $bus = array(
                    'id' => $row['id'],
                    'message' => $row['message'],
                    'from' => $row['fromUser'],
                );
                array_push($json, $bus);
            }

            $jsonstring = json_encode($json);
            echo $jsonstring;
        } else {
            echo '{}';
        }
    }

?>