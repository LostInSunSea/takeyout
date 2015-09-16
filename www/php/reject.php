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

    $tripId = $_POST['trip'];
    $otherUser = $_POST["otherUser"];
    $city = $_POST['city'];
    $country = $_POST['country'];

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($tripId == 0)
    {
        $findTripSQL = "SELECT * FROM trip WHERE city = '$city' AND country = '$country' AND owner = '$otherUser'";
        //TODO: check that it only returns 1 thing
        if ($tripResult = mysqli_query($conn,$findTripSQL))
        {
            while ($row = mysqli_fetch_array($tripResult))
            {
                $tripId = $row['id'];
            }
        }
    }

    $sql = "INSERT INTO rejection (id, sentId, receiveId, tripId) VALUES (NULL, '$id', '$otherUser', $tripId)";

    if (mysqli_query($conn, $sql))
    {
        echo "Success";
    }

?>