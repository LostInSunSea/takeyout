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

    $trip = $_GET['trip'];

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbDatabase);
    if ($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }

    $json = array();

    if ($trip == 0)
    {
        $selfSQL = "SELECT * FROM user WHERE id = '$id'";
        if ($self = mysqli_query($conn,$selfSQL))
        {
            while ($row = mysqli_fetch_array($self))
            {
                $homeCity = $row['city'];
                $homeCountry = $row['country'];
            }

            $sql = "SELECT conversation.tripId, conversation.user1, conversation.user2, user.id, user.name, user.picFull, user.headline FROM conversation INNER JOIN user ON (conversation.user1 = user.id OR conversation.user2 = user.id) WHERE conversation.city = '$homeCity' AND conversation.country = '$homeCountry' AND (conversation.user1 = '$id' OR conversation.user2 = '$id')";
        }
    }
    else
    {
        $sql = "SELECT conversation.tripId, conversation.user1, conversation.user2, user.id as userId, conversation.id as conversationId, user.name, user.picFull, user.headline FROM conversation INNER JOIN user ON (conversation.user1 = user.id OR conversation.user2 = user.id) WHERE conversation.tripId = '$trip' AND (conversation.user1 = '$id' OR conversation.user2 = '$id')";
    }
    if ($result=mysqli_query($conn,$sql))
    {
        while($row = mysqli_fetch_array($result))
        {
            if ($row['user1'] == $id)
            {
                if ($row['user2'] == $row['userId'])
                {
                    $bus = array(
                        'id' => $row['userId'],
                        'name' => $row['name'],
                        'picFull' => $row['picFull'],
                        'headline' => $row['headline'],
                        'tripId' => $row['tripId'],
                        'conversationId' => $row['conversationId']
                    );
                    array_push($json, $bus);
                }
            }
            else if ($row['user2'] == $id)
            {
                if ($row['user1'] == $row['userId'])
                {
                    $bus = array(
                        'id' => $row['userId'],
                        'name' => $row['name'],
                        'picFull' => $row['picFull'],
                        'headline' => $row['headline'],
                        'tripId' => $row['tripId'],
                        'conversationId' => $row['conversationId']
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