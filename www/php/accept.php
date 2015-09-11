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

    $otherUser = $_GET["otherUser"];
    $trip = $_GET["trip"];
    $city = $_GET["city"];
    $country = $_GET["country"];

    if ($trip == 0)
    {
        $findTripSQL = "SELECT * FROM trip WHERE city = '$city' AND country = '$country' AND owner = '$otherUser'";
        //TODO: check that it only returns 1 thing
        if ($tripResult = mysqli_query($conn,$findTripSQL))
        {
            while ($row = mysqli_fetch_array($tripResult))
            {
                $trip = $row['id'];
            }
        }
    }

    $sql = "SELECT * FROM accept WHERE receiveId = '$id' AND sentId = '$otherUser'";

    if ($result=mysqli_query($conn,$sql))
    {
        if ($result->num_rows)
        {
            while($row = mysqli_fetch_array($result))
            {
                $deleteId = $row['id'];
                $deleteSQL = "DELETE FROM accept WHERE id = '$deleteId'";
                mysqli_query($conn,$deleteSQL);
            }
            //TODO: add to the reject table
            $makeConversationSQL = "INSERT INTO conversation(id, user1, user2, tripId, city, country) VALUES (NULL,'$id','$otherUser',$trip,'$city','$country')";
            if (mysqli_query($conn,$makeConversationSQL))
            {
                echo("New conversation made");
            }
        }
        else
        {
            $makeRequestSQL = "INSERT INTO accept(id, sentId, receiveId, tripId) VALUES (NULL,'$id','$otherUser','$trip')";
            if ($newRequestResult = mysqli_query($conn,$makeRequestSQL))
            {
                //TODO: add to reject table
                echo "New request made";
            }
        }
    }

?>