<?php

    $dbHost = 'localhost';
    $dbUser = "root";
    $dbPass = "J^mpStrt";
    $dbDatabase = "takeyout";

    if (!isset($_SESSION['id']))
    {
        exit ("Error: Not logged in!");
    }

    $id = $_SESSION['id'];

    $trip = $_GET['trip'];

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $json = array();

    $sql = "SELECT conversation.tripId, conversation.user1, conversation.user2, user.id, user.name, user.picFull FROM conversation INNER JOIN user ON (conversation.user1 = user.id OR conversation.user2 = user.id) WHERE conversation.tripId = '$trip' AND (conversation.user1 = '$id' OR conversation.user2 = '$id')";
    if ($result=mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_array($result))
        {
            if ($row['user1'] == $id)
            {
                if ($row['user2'] == $row['id'])
                {
                    $bus = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'picFull' => $row['picFull']
                    );
                    array_push($json, $bus);
                }
            }
            else if ($row['user2'] == $id)
            {
                if ($row['user1'] == $row['id'])
                {
                    $bus = array(
                        'id' => $row['id'],
                        'name' => $row['name'],
                        'picFull' => $row['picFull']
                    );
                    array_push($json, $bus);
                }
            }
        }
    }
    $conn->close();

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>